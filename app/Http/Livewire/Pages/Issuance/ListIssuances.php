<?php

namespace App\Http\Livewire\Pages\Issuance;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\IssuancesDocument;
use App\Models\IssuancesDocumentType;
use App\Models\IssuancesDocumentSubType;
use App\Models\TransactingOffice;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ListIssuances extends Component
{
    use WithPagination;

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
    ];

    public function mount()
    {
        // Set default date range to last 30 days
        $this->dateTo = now()->format('Y-m-d');
        $this->dateFrom = now()->subDays(30)->format('Y-m-d');
    }

    public function updatingSearch()
    {
        $this->resetPage();
        $this->loading = true;
    }

    public function updatingSubjectSearch()
    {
        $this->resetPage();
        $this->loading = true;
    }

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
        $this->mount(); // Reset to default date range
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
                  ->orWhere('note', 'like', '%' . $this->search . '%');
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
        return IssuancesDocumentSubType::where('document_type_id', 10) // Issuances type
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
