<?php

namespace App\Http\Livewire\Pages\Issuance;

use Livewire\Component;
// Removed WithPagination for infinite scroll implementation
use Livewire\WithFileUploads;
use App\Models\IssuancesDocument;
use App\Models\IssuancesDocumentType;
use App\Models\IssuancesDocumentSubType;
use App\Models\TransactingOffice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ListIssuances extends Component
{
    use WithFileUploads;

    // Filter properties
    public $search = '';
    public $documentTypeFilter = '';
    public $subjectSearch = '';
    public $issuanceNumber = '';
    public $dateFrom = '';
    public $dateTo = '';
    public $perPage = 12;
    public $loadedItems = 12;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    // UI state
    public $showDeleteModal = false;
    public $documentToDelete = null;
    public $deletionReason = '';
    public $loading = false;
    public $showUploadModal = false;
    public $showEditModal = false;

    // Form properties
    public $editingDocument = null;
    public $uploadForm = [
        'title' => '',
        'issuance_number' => '',
        'document_sub_type_id' => '',
        'document_date' => '',
        'files' => [],
    ];
    public $uploadedFiles = [];
    public $selectedFileIndex = 0;
    public $editForm = [
        'id' => null,
        'title' => '',
        'issuance_number' => '',
        'document_sub_type_id' => '',
        'document_date' => '',
        'file' => null,
        'current_file_path' => '',
    ];
    
    // Preview state
    public $showPreview = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'documentTypeFilter' => ['except' => ''],
        'subjectSearch' => ['except' => ''],
        'issuanceNumber' => ['except' => ''],
        'dateFrom' => ['except' => ''],
        'dateTo' => ['except' => ''],
    ];

    protected $listeners = [
        'documentDeleted' => 'refreshDocuments',
        'documentUploaded' => 'refreshDocuments',
        'openUploadModal' => 'openUploadModal',
    ];

    // Reset loaded items when filters change
    public function updatedSearch()
    {
        $this->resetLoadedItems();
    }

    public function updatedDocumentTypeFilter()
    {
        $this->resetLoadedItems();
    }

    public function updatedSubjectSearch()
    {
        $this->resetLoadedItems();
    }

    public function updatedIssuanceNumber()
    {
        $this->resetLoadedItems();
    }

    public function updatedDateFrom()
    {
        $this->resetLoadedItems();
    }

    public function updatedDateTo()
    {
        $this->resetLoadedItems();
    }

    private function resetLoadedItems()
    {
        $this->loadedItems = 12;
    }

    public function mount()
    {
        // Leave date fields blank initially
    }

    // Removed automatic search triggers - users must click search button

    public function updatingDocumentTypeFilter()
    {
        $this->resetLoadedItems();
    }

    public function updatingPerPage()
    {
        $this->resetLoadedItems();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
        $this->resetLoadedItems();
    }

    public function clearFilters()
    {
        $this->reset([
            'search',
            'documentTypeFilter', 
            'subjectSearch',
            'issuanceNumber',
            'dateFrom',
            'dateTo'
        ]);
        $this->resetLoadedItems();
        $this->dispatchBrowserEvent('filters-cleared');
    }

    public function searchDocuments()
    {
        $this->resetLoadedItems();
        $this->loading = true;
        $this->dispatchBrowserEvent('search-initiated');
    }

    public function confirmDelete($documentId)
    {
        $this->documentToDelete = $documentId;
        $this->deletionReason = '';
        $this->showDeleteModal = true;
    }

    public function deleteDocument()
    {
        $this->validate([
            'deletionReason' => 'required|string|min:5|max:500',
        ], [
            'deletionReason.required' => 'Please provide a reason for deletion.',
            'deletionReason.min' => 'Deletion reason must be at least 5 characters.',
            'deletionReason.max' => 'Deletion reason cannot exceed 500 characters.',
        ]);

        if ($this->documentToDelete) {
            $document = IssuancesDocument::find($this->documentToDelete);
            if ($document) {
                // Set deletion metadata before soft delete
                $document->update([
                    'issuance_deleted_by' => auth()->id(),
                    'issuance_deletion_reason' => $this->deletionReason,
                ]);
                
                // Perform soft delete using Laravel's built-in method
                $document->delete();
                
                $this->dispatchBrowserEvent('document-deleted', [
                    'message' => 'Document deleted successfully!'
                ]);
            }
        }
        $this->cancelDelete();
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->documentToDelete = null;
        $this->deletionReason = '';
    }

    public function refreshDocuments()
    {
        // Refresh the component
    }

    public function openUploadModal()
    {
        $this->resetUploadForm();
        $this->showUploadModal = true;
    }

    public function closeUploadModal()
    {
        $this->showUploadModal = false;
        $this->resetUploadForm();
    }

    public function openEditModal($documentId)
    {
        $document = IssuancesDocument::findOrFail($documentId);
        $this->editingDocument = $document;
        $this->editForm = [
            'id' => $document->id,
            'title' => $document->document_title,
            'issuance_number' => $document->document_reference_code,
            'document_sub_type_id' => $document->document_sub_type_id,
            'document_date' => Carbon::parse($document->document_date)->format('Y-m-d'),
            'file' => null, // New file is optional
            'current_file_path' => $document->file_path,
        ];
        $this->showEditModal = true;
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->editingDocument = null;
        $this->reset('editForm');
    }

    public function updateDocument()
    {
        $this->validate([
            'editForm.title' => 'required|string|max:1000',
            'editForm.issuance_number' => 'required|string|max:100',
            'editForm.document_sub_type_id' => 'required|exists:issuance_document_sub_types,id',
            'editForm.document_date' => 'required|date',
            'editForm.file' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // 10MB max, optional
        ]);

        try {
            $originalDocument = IssuancesDocument::findOrFail($this->editForm['id']);

            // Create a new record for the new version
            $newDocumentData = [
                'document_title' => $this->editForm['title'],
                'document_reference_code' => $this->editForm['issuance_number'],
                'document_sub_type_id' => $this->editForm['document_sub_type_id'],
                'document_date' => $this->editForm['document_date'],
                'status_type_id' => $originalDocument->status_type_id,
                'office_id' => $originalDocument->office_id,
                'created_by' => $originalDocument->created_by, // Keep original creator
                'updated_by' => auth()->id(),
                'version_of_id' => $originalDocument->id, // Link to the original document
            ];

            // Handle file upload if a new file is provided
            if ($this->editForm['file']) {
                $filePath = $this->editForm['file']->store('issuance-documents', 'public');
                $originalName = $this->editForm['file']->getClientOriginalName();
                $newDocumentData['file_path'] = $filePath;
                $newDocumentData['original_filename'] = $originalName;
            } else {
                // If no new file, use the old file path
                $newDocumentData['file_path'] = $originalDocument->file_path;
                $newDocumentData['original_filename'] = $originalDocument->original_filename;
            }

            // Get the document type from the selected sub type
            $subType = \App\Models\IssuancesDocumentSubType::find($this->editForm['document_sub_type_id']);
            $newDocumentData['document_type_id'] = $subType->document_type_id;

            // Create the new version
            $newVersion = IssuancesDocument::create($newDocumentData);

            // Deactivate the old document by setting its status to 'archived' or similar
            $originalDocument->update(['status_type_id' => 4]); // Assuming 4 is 'Archived' or 'Superseded'

            $this->closeEditModal();

            $this->dispatchBrowserEvent('document-updated', [
                'message' => 'Document updated successfully! A new version has been created.',
                'type' => 'success'
            ]);

            $this->resetLoadedItems();

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('document-update-failed', [
                'message' => 'Failed to update document: ' . $e->getMessage(),
                'type' => 'error'
            ]);
        }
    }

    public function resetUploadForm()
    {
        $this->uploadForm = [
            'title' => '',
            'issuance_number' => '',
            'document_sub_type_id' => '',
            'document_date' => '',
            'files' => [],
        ];
        $this->uploadedFiles = [];
        $this->selectedFileIndex = 0;
        $this->showPreview = false;
    }

    public function updatedUploadFormFiles()
    {
        $this->uploadedFiles = [];
        if (!empty($this->uploadForm['files'])) {
            foreach ($this->uploadForm['files'] as $index => $file) {
                $this->uploadedFiles[] = [
                    'index' => $index,
                    'name' => $file->getClientOriginalName(),
                    'size' => $this->formatFileSize($file->getSize()),
                    'type' => $file->getClientMimeType(),
                ];
            }
            
            // Auto-show preview if the first file is a PDF
            $firstFile = $this->uploadForm['files'][0] ?? null;
            if ($firstFile && strtolower(pathinfo($firstFile->getClientOriginalName(), PATHINFO_EXTENSION)) === 'pdf') {
                $this->showPreview = true;
            }
        }
    }

    public function removeFile($index)
    {
        if (isset($this->uploadForm['files'][$index])) {
            unset($this->uploadForm['files'][$index]);
            $this->uploadForm['files'] = array_values($this->uploadForm['files']); // Re-index array
            
            // Reset selectedFileIndex if the selected file was removed or if it's out of bounds
            if ($this->selectedFileIndex >= count($this->uploadForm['files'])) {
                $this->selectedFileIndex = max(0, count($this->uploadForm['files']) - 1);
            }
            
            $this->updatedUploadFormFiles(); // Update the display list
        }
    }

    private function formatFileSize($bytes)
    {
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }

    public function togglePreview()
    {
        $this->showPreview = !$this->showPreview;
    }

    public function uploadDocument()
    {
        $this->validate([
            'uploadForm.title' => 'required|string|max:1000',
            'uploadForm.issuance_number' => 'required|string|max:100',
            'uploadForm.document_sub_type_id' => 'required|exists:issuance_document_sub_types,id',
            'uploadForm.document_date' => 'required|date',
            'uploadForm.files' => 'required|array|min:1',
            'uploadForm.files.*' => 'required|file|mimes:pdf,doc,docx|max:15360', // 15MB max per file
        ]);

        try {
            // Get the document type from the selected sub type
            $subType = \App\Models\IssuancesDocumentSubType::find($this->uploadForm['document_sub_type_id']);
            
            // Use the first file as the primary document
            $primaryFile = $this->uploadForm['files'][0];
            $filePath = $primaryFile->store('issuance-documents', 'public');
            $originalName = $primaryFile->getClientOriginalName();

            // Create a single document record
            $document = IssuancesDocument::create([
                'document_title' => $this->uploadForm['title'],
                'document_reference_code' => $this->uploadForm['issuance_number'],
                'document_type_id' => $subType->document_type_id,
                'document_sub_type_id' => $this->uploadForm['document_sub_type_id'],
                'document_date' => $this->uploadForm['document_date'],
                'file_path' => $filePath,
                'original_filename' => $originalName,
                'status_type_id' => 2, // Published status
                'office_id' => auth()->user()->office_id ?? 1, // Default to office 1 if user has no office
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
            ]);

            // If there are additional files, store them as attachments or versions
            if (count($this->uploadForm['files']) > 1) {
                for ($i = 1; $i < count($this->uploadForm['files']); $i++) {
                    $additionalFile = $this->uploadForm['files'][$i];
                    $additionalFilePath = $additionalFile->store('issuance-documents', 'public');
                    $additionalOriginalName = $additionalFile->getClientOriginalName();

                    // Create additional document records linked to the main document
                    IssuancesDocument::create([
                        'document_title' => $this->uploadForm['title'] . ' - Attachment ' . $i,
                        'document_reference_code' => $this->uploadForm['issuance_number'],
                        'document_type_id' => $subType->document_type_id,
                        'document_sub_type_id' => $this->uploadForm['document_sub_type_id'],
                        'document_date' => $this->uploadForm['document_date'],
                        'file_path' => $additionalFilePath,
                        'original_filename' => $additionalOriginalName,
                        'status_type_id' => 2, // Published status
                        'office_id' => auth()->user()->office_id ?? 1,
                        'created_by' => auth()->id(),
                        'updated_by' => auth()->id(),
                        'parent_document_id' => $document->id, // Link to main document if this field exists
                    ]);
                }
            }

            // Reset form and close modal
            $this->resetUploadForm();
            $this->closeUploadModal();

            // Dispatch success event for toastr notification
            $fileCount = count($this->uploadForm['files']);
            $message = $fileCount === 1 ? 'Document uploaded successfully!' : "Document with {$fileCount} files uploaded successfully!";
            
            $this->dispatchBrowserEvent('document-uploaded', [
                'message' => $message,
                'type' => 'success'
            ]);

            // Refresh the documents list
            $this->resetLoadedItems();

        } catch (\Exception $e) {
            // Dispatch error event for toastr notification
            $this->dispatchBrowserEvent('document-upload-failed', [
                'message' => 'Failed to upload document: ' . $e->getMessage(),
                'type' => 'error'
            ]);
        }
    }

    public function loadMore()
    {
        $this->loadedItems += 12;
    }

    public function getDocumentsProperty()
    {
        $query = IssuancesDocument::query()
            ->with(['documentType', 'documentSubType', 'office', 'creator', 'versions'])
            ->issuances() // Only issuance documents
            ->active(); // Only active documents

        // Apply filters
        if ($this->search) {
            $query->where(function($q) {
                $q->where('document_title', 'like', '%' . $this->search . '%')
                  ->orWhere('document_reference_code', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->subjectSearch) {
            $query->where('document_title', 'like', '%' . $this->subjectSearch . '%');
        }

        if ($this->documentTypeFilter) {
            $query->where('document_sub_type_id', $this->documentTypeFilter);
        }

        if ($this->issuanceNumber) {
            $query->where('document_reference_code', 'like', '%' . $this->issuanceNumber . '%');
        }

        if ($this->dateFrom) {
            $query->whereDate('created_at', '>=', $this->dateFrom);
        }

        if ($this->dateTo) {
            $query->whereDate('created_at', '<=', $this->dateTo);
        }

        // Apply sorting
        $query->orderBy($this->sortField, $this->sortDirection);

        return $query->take($this->loadedItems)->get();
    }

    public function getTotalDocumentsProperty()
    {
        $query = IssuancesDocument::query()
            ->issuances()
            ->active();

        // Apply same filters for count
        if ($this->search) {
            $query->where(function($q) {
                $q->where('document_title', 'like', '%' . $this->search . '%')
                  ->orWhere('document_reference_code', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->subjectSearch) {
            $query->where('document_title', 'like', '%' . $this->subjectSearch . '%');
        }

        if ($this->documentTypeFilter) {
            $query->where('document_sub_type_id', $this->documentTypeFilter);
        }

        if ($this->issuanceNumber) {
            $query->where('document_reference_code', 'like', '%' . $this->issuanceNumber . '%');
        }

        if ($this->dateFrom) {
            $query->whereDate('created_at', '>=', $this->dateFrom);
        }

        if ($this->dateTo) {
            $query->whereDate('created_at', '<=', $this->dateTo);
        }

        return $query->count();
    }

    public function getDocumentSubTypesProperty()
    {
        return \App\Models\IssuancesDocumentSubType::with('documentType')
            ->where('document_type_id', 10) // Only Issuances document type
            ->orderBy('document_sub_type_name')
            ->get();
    }

    public function render()
    {
        $this->loading = false;
        
        return view('livewire.pages.issuance.list-issuances', [
            'documents' => $this->documents,
            'documentSubTypes' => $this->documentSubTypes,
            'totalDocuments' => $this->totalDocuments,
            'hasMoreItems' => $this->loadedItems < $this->totalDocuments,
        ]);
    }
}
