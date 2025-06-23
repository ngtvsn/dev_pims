<?php

namespace App\Http\Livewire\Pages\Css\Responses;

use App\Models\CssResponse;
use App\Models\TransactingOffice;
use App\Models\AvailedService;
use App\Models\ClientGroup;
use App\Models\ClientType;
use App\Models\StatusType;

use App\Exports\ExportCssResponses;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Carbon\Carbon;

class ListCssResponses extends Component
{
    use WithFileUploads;
    use WithPagination;
    //Page
    public $paginate = 10;
    public $searchInput;
    protected $searchList;
    protected $pagination = 5;
    public $search = "";
    public $selectPage = false;
    public $checked = [];
    public $selectAll = false;
    //Filter
    public $SelectedStatusType = NULL;
    public $SelectedAvailedService = NULL;
    public $SelectedClientGroup = NULL;
    public $SelectedClientType = NULL;
    public $SelectedSexType = NULL;
    public $SelectedTransactingOffice = NULL;
    //List
    public $response = NULL;
    public $response_id = NULL;
    public $password;
    
    public function getResponsesProperty()
    { 
        return $this->responsesQuery
        ->orderBy('id', 'desc')
        ->paginate($this->paginate); 
    }
    
    public function getResponsesQueryProperty()
    {
        return CssResponse::with(['status_type', 'availed_service', 'client_group', 'client_type', 'sex_type', 'transacting_office'])
            ->when($this->SelectedStatusType, function ($query) {
                $query->where('status_type_id', $this->SelectedStatusType);
            })
            ->when($this->SelectedAvailedService, function ($query) {
                $query->where('availed_service_id', $this->SelectedAvailedService);
            })
            ->when($this->SelectedClientGroup, function ($query) {
                $query->where('client_group_id', $this->SelectedClientGroup);
            })
            ->when($this->SelectedClientType, function ($query) {
                $query->where('client_type_id', $this->SelectedClientType);
            })
            ->when($this->SelectedSexType, function ($query) {
                $query->where('sex_type_id', $this->SelectedSexType);
            })
            ->when($this->SelectedTransactingOffice, function ($query) {
                $query->where('transacting_office_id', $this->SelectedTransactingOffice);
            })
            ->search(trim($this->search));
    }
    
    public function render()
    {
        return view('livewire.pages.css.responses.list-css-responses', [
            'css_responses' => $this->responses,
            'transacting_offices' => TransactingOffice::all(),
            'years' => DB::table('css_responses')->select(DB::raw('YEAR(date_accomplished) as `year`'))->get(),
            'availed_services' => AvailedService::all(),
            'client_types' => ClientType::all(),
            'client_groups' => ClientGroup::all(),
            'status_types' => StatusType::all(),
        ]);
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->checked = $this->responses->pluck('id')->map(fn ($item) => (string) $item)->toArray();
        } else {
            $this->checked = [];
        }
    }

    public function updatedChecked()
    {
        $this->selectPage = false;
    }

    public function selectAll()
    {
        $this->selectAll = true;

        $this->checked = $this->responsesQuery
        ->pluck('id')
        ->map(fn ($item) => (string) $item)
        ->toArray();     
    }

    public function exportSelected()
    {
        return (new ExportCssResponses($this->checked))->download('css_responses.xls');
    }

    public function DeleteForm($response_id)
    {
        $this->response_id = $response_id;
        $this->password = '';
        $this->dispatchBrowserEvent('show-delete-form');
    }

    public function Delete()
    {
        $this->validate([
            'password' => 'required',
        ]);
        if (Hash::check($this->password, Auth::user()->password)) {
            $csm_response = CssResponse::findOrFail($this->response_id);
            $csm_response->delete();
            $this->checked = array_diff($this->checked, [$this->response_id]);
            $this->dispatchBrowserEvent('success-message', ['message' => 'Record Deleted successfully!']);
            return redirect()->back();
        } else {
            $this->dispatchBrowserEvent('error-message', ['message' => 'Incorrect Password']);
        }
    } 

    public function isChecked($response_id)
    {
        return in_array($response_id, $this->checked);
    }  
}
