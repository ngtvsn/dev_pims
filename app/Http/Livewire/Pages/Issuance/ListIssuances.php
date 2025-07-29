<?php

namespace App\Http\Livewire\Pages\Issuance;

use Livewire\Component;
use Livewire\WithPagination;
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
    use WithPagination, WithFileUploads;

    // Filter properties
    public $search = '';
    public $documentTypeFilter = '';
    public $subjectSearch = '';
    public $issuanceNumber = '';
    public $dateFrom = '';
    public $dateTo = '';
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    // UI state
    public $showDeleteModal = false;
    public $documentToDelete = null;
    public $loading = false;
    public $showUploadModal = false;
    
    // Upload form properties
    public $uploadForm = [
        'title' => '',
        'issuance_number' => '',
        'document_sub_type_id' => '',
        'document_date' => '',
        'description' => '',
        'file' => null,
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
        'perPage' => ['except' => 10],
        'page' => ['except' => 1],
    ];

    protected $listeners = [
        'documentDeleted' => 'refreshDocuments',
        'documentUpdated' => 'refreshDocuments',
        'openUploadModal' => 'openUploadModal',
    ];

    public function mount()
    {
        // Leave date fields blank initially
    }

    // Removed automatic search triggers - users must click search button

    public function updatingDocumentTypeFilter()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
        $this->resetPage();
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
        $this->resetPage();
        $this->dispatchBrowserEvent('filters-cleared');
    }

    public function searchDocuments()
    {
        $this->resetPage();
        $this->loading = true;
        $this->dispatchBrowserEvent('search-initiated');
    }

    public function confirmDelete($documentId)
    {
        $this->documentToDelete = $documentId;
        $this->showDeleteModal = true;
    }

    public function deleteDocument()
    {
        if ($this->documentToDelete) {
            $document = IssuancesDocument::find($this->documentToDelete);
            if ($document) {
                $document->delete();
                $this->dispatchBrowserEvent('document-deleted', [
                    'message' => 'Document deleted successfully!'
                ]);
            }
        }
        $this->showDeleteModal = false;
        $this->documentToDelete = null;
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->documentToDelete = null;
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

    public function resetUploadForm()
    {
        $this->uploadForm = [
            'title' => '',
            'issuance_number' => '',
            'document_sub_type_id' => '',
            'document_date' => '',
            'description' => '',
            'file' => null,
        ];
        $this->showPreview = false;
    }

    public function removeFile()
    {
        $this->uploadForm['file'] = null;
        $this->showPreview = false;
    }
    
    public function togglePreview()
    {
        $this->showPreview = !$this->showPreview;
    }

    public function uploadDocument()
    {
        $this->validate([
            'uploadForm.title' => 'required|string|max:255',
            'uploadForm.issuance_number' => 'required|string|max:100',
            'uploadForm.document_sub_type_id' => 'required|exists:issuance_document_sub_types,id',
            'uploadForm.document_date' => 'required|date',
            'uploadForm.description' => 'required|string|max:1000',
            'uploadForm.file' => 'required|file|mimes:pdf,doc,docx|max:10240', // 10MB max
        ]);

        try {
            // Store the uploaded file
            $filePath = $this->uploadForm['file']->store('issuance-documents', 'public');
            $originalName = $this->uploadForm['file']->getClientOriginalName();

            // Get the document type from the selected sub type
            $subType = \App\Models\IssuancesDocumentSubType::find($this->uploadForm['document_sub_type_id']);
            
            // Create the document record
            IssuancesDocument::create([
                'document_title' => $this->uploadForm['title'],
                'document_reference_code' => $this->uploadForm['issuance_number'],
                'document_type_id' => $subType->document_type_id,
                'document_sub_type_id' => $this->uploadForm['document_sub_type_id'],
                'document_date' => $this->uploadForm['document_date'],
                'description' => $this->uploadForm['description'],
                'file_path' => $filePath,
                'original_filename' => $originalName,
                'status_type_id' => 2, // Published status
                'office_id' => auth()->user()->office_id ?? 1, // Default to office 1 if user has no office
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
            ]);

            // Reset form and close modal
            $this->resetUploadForm();
            $this->closeUploadModal();

            // Show success message
            session()->flash('message', 'Document uploaded successfully!');

            // Refresh the documents list
            $this->resetPage();

        } catch (\Exception $e) {
            // Handle any errors
            session()->flash('error', 'Failed to upload document: ' . $e->getMessage());
        }
    }

    public function getDocumentsProperty()
    {
        $query = IssuancesDocument::query()
            ->with(['documentType', 'documentSubType', 'office', 'creator'])
            ->issuances() // Only issuance documents
            ->active(); // Only active documents

        // Apply filters
        if ($this->search) {
            $query->where(function($q) {
                $q->where('document_title', 'like', '%' . $this->search . '%')
                  ->orWhere('document_reference_code', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
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

        return $query->paginate($this->perPage);
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
            'totalDocuments' => $this->documents->total(),
        ]);
    }
}
