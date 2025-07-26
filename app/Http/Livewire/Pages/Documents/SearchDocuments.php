<?php

namespace App\Http\Livewire\Pages\Documents;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\IssuancesDocument;
use App\Models\IssuancesDocumentSubType;
use Illuminate\Support\Str;

class SearchDocuments extends Component
{
    use WithPagination;

    // Search properties
    public $documentTypeFilter = '';
    public $subjectSearch = '';
    public $keywords = '';
    public $dateFrom = '';
    public $dateTo = '';
    public $issuanceNumber = '';
    public $controlNumber = '';
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    // UI state
    public $loading = false;
    public $showResults = false;
    public $totalResults = 0;

    protected $queryString = [
        'documentTypeFilter' => ['except' => ''],
        'subjectSearch' => ['except' => ''],
        'keywords' => ['except' => ''],
        'dateFrom' => ['except' => ''],
        'dateTo' => ['except' => ''],
        'issuanceNumber' => ['except' => ''],
        'controlNumber' => ['except' => ''],
        'perPage' => ['except' => 10],
        'page' => ['except' => 1],
    ];

    protected $listeners = [
        'searchInitiated' => 'handleSearchInitiated',
    ];

    public function mount()
    {
        // Check if there are any search parameters in the URL
        if ($this->hasSearchCriteria()) {
            $this->showResults = true;
            $this->searchDocuments();
        }
    }

    public function updatedDocumentTypeFilter()
    {
        $this->resetPage();
        if ($this->showResults) {
            $this->searchDocuments();
        }
    }

    public function updatedSubjectSearch()
    {
        $this->resetPage();
        if ($this->showResults) {
            $this->searchDocuments();
        }
    }

    public function updatedKeywords()
    {
        $this->resetPage();
        if ($this->showResults) {
            $this->searchDocuments();
        }
    }

    public function updatedDateFrom()
    {
        $this->resetPage();
        if ($this->showResults) {
            $this->searchDocuments();
        }
    }

    public function updatedDateTo()
    {
        $this->resetPage();
        if ($this->showResults) {
            $this->searchDocuments();
        }
    }

    public function updatedIssuanceNumber()
    {
        $this->resetPage();
        if ($this->showResults) {
            $this->searchDocuments();
        }
    }

    public function updatedControlNumber()
    {
        $this->resetPage();
        if ($this->showResults) {
            $this->searchDocuments();
        }
    }

    public function searchDocuments()
    {
        $this->loading = true;
        $this->showResults = true;
        $this->resetPage();
        
        // Emit browser event for UI feedback
        $this->dispatchBrowserEvent('search-initiated');
        
        // Simulate loading delay for better UX
        $this->loading = false;
    }

    public function clearFilters()
    {
        $this->reset([
            'documentTypeFilter',
            'subjectSearch', 
            'keywords',
            'dateFrom',
            'dateTo',
            'issuanceNumber',
            'controlNumber'
        ]);
        
        $this->showResults = false;
        $this->resetPage();
        
        // Emit browser event
        $this->dispatchBrowserEvent('filters-cleared');
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

    public function getDocumentSubTypesProperty()
    {
        return IssuancesDocumentSubType::where('document_type_id', 10)
            ->orderBy('document_sub_type_name')
            ->get();
    }

    public function getDocumentsProperty()
    {
        if (!$this->showResults) {
            return collect();
        }

        $query = IssuancesDocument::query()
            ->with(['documentType', 'documentSubType', 'office', 'creator'])
            ->issuances() // Only issuance documents
            ->active(); // Only active documents

        // Apply filters
        if ($this->subjectSearch) {
            $query->where('document_title', 'like', '%' . $this->subjectSearch . '%');
        }

        if ($this->keywords) {
            $keywords = explode(',', $this->keywords);
            $query->where(function($q) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $keyword = trim($keyword);
                    if (!empty($keyword)) {
                        $q->orWhere('document_title', 'like', '%' . $keyword . '%')
                          ->orWhere('document_reference_code', 'like', '%' . $keyword . '%')
                          ->orWhere('note', 'like', '%' . $keyword . '%');
                    }
                }
            });
        }

        if ($this->documentTypeFilter) {
            $query->where('document_sub_type_id', $this->documentTypeFilter);
        }

        if ($this->issuanceNumber) {
            $query->where('document_reference_code', 'like', '%' . $this->issuanceNumber . '%');
        }

        if ($this->controlNumber) {
            $query->where('document_reference_code', 'like', '%' . $this->controlNumber . '%');
        }

        if ($this->dateFrom) {
            $query->whereDate('created_at', '>=', $this->dateFrom);
        }

        if ($this->dateTo) {
            $query->whereDate('created_at', '<=', $this->dateTo);
        }

        // Apply sorting
        $query->orderBy($this->sortField, $this->sortDirection);

        $results = $query->paginate($this->perPage);
        $this->totalResults = $results->total();

        return $results;
    }

    public function getTotalResultsProperty()
    {
        return $this->totalResults;
    }

    private function hasSearchCriteria()
    {
        return !empty($this->documentTypeFilter) ||
               !empty($this->subjectSearch) ||
               !empty($this->keywords) ||
               !empty($this->dateFrom) ||
               !empty($this->dateTo) ||
               !empty($this->issuanceNumber) ||
               !empty($this->controlNumber);
    }

    public function handleSearchInitiated()
    {
        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.pages.documents.search-documents')
            ->layout('layouts.app')
            ->title('Search Documents - PIMS');
    }
}