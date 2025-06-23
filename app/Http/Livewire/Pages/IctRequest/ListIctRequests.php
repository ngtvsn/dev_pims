<?php

namespace App\Http\Livewire\Pages\IctRequest;

use App\Models\IctRequest;
use App\Models\RequestStatusType;
use App\Models\RequestType;
use App\Models\SubRequestType;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Exports\IctRequestsExport;

class ListIctRequests extends Component
{
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
    public $SelectedRequestStatusType = NULL;
    public $SelectedRequestType = NULL;
    public $SelectedSubRequestType = NULL;

    //Data Input
    public $request = NULL;
    public $request_id = NULL;
    public $ticket_no = NULL;
    public $request_type_id = NULL;
    public $sub_request_type_id = NULL;
    public $request_details = NULL;
    public $technical_support_representative_name = NULL;
    public $technical_support_representative_findings = NULL;
    public $reason_for_cancellation = NULL;
    public $action_taken = NULL;
    public $last_name = NULL;
    public $first_name = NULL;
    public $middle_name = NULL;
    public $email = NULL;
    public $local = NULL;
    public $position_name = NULL;
    public $office_name = NULL;
    public $division_name = NULL;
    public $resolved_datetime = NULL;
    public $created_at = NULL;
    public $updated_at = NULL;
    public $created_by = NULL;
    public $updated_by = NULL;
    //Delete
    public $password;
    //Others
    
    public function ClearFilter()
    {
        $this->search = NULL;
        $this->SelectedRequestStatusType = NULL;
        $this->SelectedRequestType = NULL;
        $this->SelectedSubRequestType = NULL;
    }

    public function AddIctRequestForm()
    {
        $this->request_type_id = NULL;
        $this->sub_request_type_id = NULL;
        $this->request_details = NULL;
        $this->dispatchBrowserEvent('show-add-ict-request-form'); 
    }

    public function AddIctRequest()
    {
        $current_year = Carbon::now()->format('Y');
        $this->validate([
            'request_type_id' => 'required',
            'sub_request_type_id' => 'required',
            'request_details' => 'required',
        ]);    
        
        $total_requests = IctRequest::whereYear('created_at', now()->year)->count();
        IctRequest::create([
            'request_status_type_id' => 1,
            'ticket_no' => 'ICT-'.$current_year.'-'.str_pad($total_requests + 1, 3, '0', STR_PAD_LEFT),
            'request_type_id' => $this->request_type_id,
            'sub_request_type_id' => $this->sub_request_type_id,
            'request_details' => $this->request_details,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id()
        ]);
        $this->dispatchBrowserEvent('success-message', ['message' => 'Your ICT Request has been submitted successfully! Please wait for a Technical Support Representative to respond on your request.']);
        $this->search = NULL;
        $this->SelectedRequestStatusType = NULL;
        $this->SelectedRequestType = NULL;
        $this->SelectedSubRequestType = NULL;
        return redirect()->back();
    }    

    public function StartRequestForm(IctRequest $request)
    {
        $this->request = $request;
        $this->created_at = $request->created_at->format('F d, Y - h:i A');
        $this->last_name = $request->user_created->last_name;
        $this->first_name = $request->user_created->first_name;
        $this->middle_name = optional($request->user_created)->middle_name;
        $this->email = optional($request->user_created)->email;
        $this->local = optional($request->user_created)->local;
        $this->position_name = optional($request->user_created->position)->position_name;
        $this->office_name = optional($request->user_created->office)->office_name;
        $this->division_name = optional($request->user_created->division)->division_name;
        $this->ticket_no = $request->ticket_no;
        $this->request_type_id = $request->request_type_id;
        $this->sub_request_type_id = $request->sub_request_type_id;
        $this->request_details = $request->request_details;
        $this->dispatchBrowserEvent('show-start-request-form');
    }
    
    public function StartRequest()
    {
        $this->request->update([
            'request_status_type_id' => 2,
            'technical_support_representative_id' => Auth::id(),
            'action_taken_datetime' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_by' => Auth::id()
        ]);     
        $this->dispatchBrowserEvent('success-message', ['message' => 'You may now start attending to the service request.']);
        $this->search = NULL;
        $this->SelectedRequestStatusType = NULL;
        $this->SelectedRequestType = NULL;
        $this->SelectedSubRequestType = NULL;
        return redirect()->back(); 
    }

    public function ResolveRequestForm(IctRequest $request)
    {
        $this->request = $request;
        $this->created_at = $request->created_at->format('F d, Y - h:i A');
        $this->last_name = $request->user_created->last_name;
        $this->first_name = $request->user_created->first_name;
        $this->middle_name = optional($request->user_created)->middle_name;
        $this->email = optional($request->user_created)->email;
        $this->local = optional($request->user_created)->local;
        $this->position_name = optional($request->user_created->position)->position_name;
        $this->office_name = optional($request->user_created->office)->office_name;
        $this->division_name = optional($request->user_created->division)->division_name;
        $this->ticket_no = $request->ticket_no;
        $this->request_type_id = $request->request_type_id;
        $this->sub_request_type_id = $request->sub_request_type_id;
        $this->request_details = $request->request_details;
        $this->technical_support_representative_name = $request->technical_support_representative->last_name.', '.$request->technical_support_representative->first_name.' '.$request->technical_support_representative->middle_name;
        $this->technical_support_representative_findings = NULL;
        $this->action_taken = NULL;
        $this->dispatchBrowserEvent('show-resolve-request-form');
    }
    
    public function ResolveRequest()
    {
        $this->validate([
            'technical_support_representative_findings' => 'required',
            'action_taken' => 'required',
        ]);
        $this->request->update([
            'request_status_type_id' => 3,
            'resolved_datetime' => Carbon::now()->format('Y-m-d H:i:s'),
            'technical_support_representative_findings' => $this->technical_support_representative_findings,
            'action_taken' => $this->action_taken,
            'updated_by' => Auth::id()
        ]);     
        $this->dispatchBrowserEvent('success-message', ['message' => 'You may now inform the requestor that the ticket can be closed.']);
        $this->search = NULL;
        $this->SelectedRequestStatusType = NULL;
        $this->SelectedRequestType = NULL;
        $this->SelectedSubRequestType = NULL;
        return redirect()->back(); 
    }

    public function CloseRequestForm(IctRequest $request)
    {
        $this->request = $request;
        $this->created_at = $request->created_at->format('F d, Y - h:i A');
        $this->last_name = $request->user_created->last_name;
        $this->first_name = $request->user_created->first_name;
        $this->middle_name = optional($request->user_created)->middle_name;
        $this->email = optional($request->user_created)->email;
        $this->local = optional($request->user_created)->local;
        $this->position_name = optional($request->user_created->position)->position_name;
        $this->office_name = optional($request->user_created->office)->office_name;
        $this->division_name = optional($request->user_created->division)->division_name;
        $this->ticket_no = $request->ticket_no;
        $this->request_type_id = $request->request_type_id;
        $this->sub_request_type_id = $request->sub_request_type_id;
        $this->request_details = $request->request_details;
        $this->technical_support_representative_name = $request->technical_support_representative->last_name.', '.$request->technical_support_representative->first_name.' '.$request->technical_support_representative->middle_name;
        $this->technical_support_representative_findings = $request->technical_support_representative_findings;
        $this->action_taken = $request->action_taken;
        $this->resolved_datetime = (new \DateTime($request->resolved_datetime))->format('F d, Y - h:i A');
        $this->dispatchBrowserEvent('show-close-request-form');
    }
    
    public function CloseRequest()
    {
        $this->request->update([
            'request_status_type_id' => 4,
            'acknowledged_datetime' => Carbon::now()->format('Y-m-d H:i:s'),
            'technical_support_representative_findings' => $this->technical_support_representative_findings,
            'action_taken' => $this->action_taken,
            'updated_by' => Auth::id()
        ]);     
        $this->dispatchBrowserEvent('success-message', ['message' => 'This ticket is now closed.']);
        $this->search = NULL;
        $this->SelectedRequestStatusType = NULL;
        $this->SelectedRequestType = NULL;
        $this->SelectedSubRequestType = NULL;
        return redirect()->back(); 
    }
    
    public function CancelIctRequestForm(IctRequest $request)
    {
        $this->request = $request;
        $this->reason_for_cancellation = NULL;
        $this->dispatchBrowserEvent('show-cancel-ict-request-form');
    }
    
    public function CancelIctRequest()
    {
        $this->validate([
            'reason_for_cancellation' => 'required',
        ]);
        $this->request->update([
            'request_status_type_id' => 5,
            'reason_for_cancellation' => $this->reason_for_cancellation,
            'cancelled_datetime' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_by' => Auth::id()
        ]);     
        $this->dispatchBrowserEvent('success-message', ['message' => 'ICT Service request cancelled successfully!']);
        $this->search = NULL;
        $this->SelectedRequestStatusType = NULL;
        $this->SelectedRequestType = NULL;
        $this->SelectedSubRequestType = NULL;
        return redirect()->back(); 
    } 

    public function DeleteForm($request_id)
    {
        $this->request_id = $request_id;
        $this->password = '';
        $this->dispatchBrowserEvent('show-delete-form');
    }

    public function Delete()
    {
        $this->validate([
            'password' => 'required',
        ]);
        if (Hash::check($this->password, Auth::user()->password)) {
            $ict_request = IctRequest::findOrFail($this->request_id);
            $ict_request->delete();
            $this->checked = array_diff($this->checked, [$this->request_id]);
            $this->dispatchBrowserEvent('success-message', ['message' => 'Record Deleted successfully!']);
            return redirect()->back();
        } else {
            $this->dispatchBrowserEvent('error-message', ['message' => 'Incorrect Password']);
        }
    } 
    
    public function getIctRequestsProperty()
    { 
        if(Auth::user()->userlevel_id == 1)
        {
        return $this->ict_requestsQuery
        ->orderBy('updated_at', 'desc')
        ->paginate($this->paginate); 
        }else{
        return $this->ict_requestsQuery
        ->where('created_by', Auth::user()->id)
        ->orderBy('updated_at', 'desc')
        ->paginate($this->paginate);  
        }
       
    }

    public function getIctRequestsQueryProperty()
    {
        return IctRequest::with(['request_status_type', 'request_type', 'sub_request_type'])
            ->when($this->SelectedRequestStatusType, function ($query) {
                $query->where('request_status_type_id', $this->SelectedRequestStatusType);
            })
            ->when($this->SelectedRequestType, function ($query) {
                $query->where('request_type_id', $this->SelectedRequestType);
            })
            ->when($this->SelectedSubRequestType, function ($query) {
                $query->where('sub_request_type_id', $this->SelectedSubRequestType);
            })
            ->search(trim($this->search));
    }
    
    public function render()
    {
        return view('livewire.pages.ict-request.list-ict-requests', 
        [
            'ict_requests' => $this->ict_requests,
            'request_status_types' => RequestStatusType::all(),
            'technical_support_representatives' => User::where('id', Auth::user()->id)->get(),
            'request_types' => RequestType::all(),
            'sub_request_types' => SubRequestType::where('request_type_id', $this->SelectedRequestType)->get(),
            'form_sub_request_types' => SubRequestType::where('request_type_id', $this->request_type_id)->get(),
        ]);
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->checked = $this->ict_requests->pluck('id')->map(fn ($item) => (string) $item)->toArray();
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

        $this->checked = $this->ict_requestsQuery
        ->pluck('id')
        ->map(fn ($item) => (string) $item)
        ->toArray();     
    }

    public function exportSelected()
    {
        $currentDate = Carbon::now();
        $currentYear = $currentDate->year;
        $currentMonth = $currentDate->month;
        $currentDay = $currentDate->day;
        return (new IctRequestsExport($this->checked))->download('ICT Requests-'.$currentYear.'-'.$currentMonth.'-'.$currentDay.'.xlsx');
    }

    public function isChecked($request_id)
    {
        return in_array($request_id, $this->checked);
    }  
}
