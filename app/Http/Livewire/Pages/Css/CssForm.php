<?php

namespace App\Http\Livewire\Pages\Css;

use Livewire\Component;
use App\Models\Region;
use App\Models\SexType;
use App\Models\ClientGroup;
use App\Models\ClientType;
use App\Models\TransactingOffice;
use App\Models\ServiceType;
use App\Models\AvailedService;
use App\Models\AwarenessResponse;
use App\Models\VisibilityResponse;
use App\Models\HelpfulnessResponse;
use App\Models\Rating;
use App\Models\CssResponse;

use Carbon\Carbon;

class CssForm extends Component
{
    public $client_name;
    public $sex_type_id;
    public $region_id;
    public $contact_details;
    public $client_group_id;
    public $client_type_id;
    public $specify_client_type;
    public $date_transacted;
    public $transacting_office_id;
    public $availed_service_id;
    public $other_service_availed;
    public $awareness_response_id;
    public $visibility_response_id;
    public $helpfulness_response_id;
    public $responsiveness_rate_id;
    public $reliability_rate_id;
    public $facility_access_rate_id;
    public $communication_rate_id;
    public $cost_rate_id;
    public $integrity_rate_id;
    public $assurance_rate_id;
    public $outcome_rate_id;
    public $overall_rate_id;
    public $overall_remarks;

    public $totalSteps = 10;
    public $currentStep = 1;

    public function mount(){
        $this->currentStep = 1;
    }
    
    public function render()
    {
        return view('livewire.pages.css.css-form', [
            'regions' => Region::all(),
            'sex_types' => SexType::all(),
            'client_groups' => ClientGroup::all(),
            'client_types' => ClientType::all(),
            'transacting_offices' => TransactingOffice::all(),
            'service_types' => ServiceType::all(),
            'availed_services' => AvailedService::all(),
            'awareness_responses' => AwarenessResponse::all(),
            'visibility_responses' => VisibilityResponse::all(),
            'helpfulness_responses' => HelpfulnessResponse::all(),
            'ratings' => Rating::orderBy('id', 'DESC')->get(),
        ]);
    }

    public function increaseStep(){
        $this->resetErrorBag();
        $this->validateData();
        $this->currentStep++;
        if($this->currentStep > $this->totalSteps){
            $this->currentStep = $this->totalSteps;
        }
    }

    public function decreaseStep(){
        $this->resetErrorBag();
        $this->currentStep--;
        if($this->currentStep < 1){
            $this->currentStep = 1;
        }
    }

    public function validateData(){

        if( $this->currentStep == 2){
            $this->validate([
                'sex_type_id' => 'required',
                'region_id' => 'required',
            ], [
                'sex_type_id.required' => 'This field is required.',
                'region_id.required' => 'This field is required.',
            ]);
        }elseif($this->currentStep == 3){
            $this->validate([
                'client_group_id' => 'required',
                'client_type_id' => 'required',
                'specify_client_type' => 'required_if:client_type_id,7',
            ], [
                'client_group_id.required' => 'This field is required.',
                'client_type_id.required' => 'This field is required.',
                'specify_client_type.required_if' => 'This field is required.',
            ]);
        }elseif($this->currentStep == 4){
            $this->validate([
                'date_transacted' => 'required|before_or_equal:today',
                'transacting_office_id' => 'required',
                'availed_service_id' => 'required',
                'other_service_availed' => 'required_if:availed_service_id,33',
            ], [
                'date_transacted.required' => 'This field is required.',
                'transacting_office_id.required' => 'This field is required.',
                'availed_service_id.required' => 'This field is required.',
                'date_transacted.date_format' => 'Date does not match the format mm/dd/yyyy.',
                'date_transacted.before_or_equal' => 'Date must not be a future date.',
                'other_service_availed.required_if' => 'This field is required.',
            ]);
        }elseif($this->currentStep == 5){
            $this->validate([
                'awareness_response_id' => 'required',
                'visibility_response_id' => 'required_if:awareness_response_id,1|required_if:awareness_response_id,2|required_if:awareness_response_id,3',
                'helpfulness_response_id' => 'required_if:awareness_response_id,1|required_if:awareness_response_id,2|required_if:awareness_response_id,3',
            ], [
                'awareness_response_id.required' => 'This field is required.',
                'visibility_response_id.required_if' => 'This field is required.',
                'helpfulness_response_id.required_if' => 'This field is required.',
            ]);
        }elseif($this->currentStep == 6){
            $this->validate([
                'responsiveness_rate_id' => 'required',
                'reliability_rate_id' => 'required',
                'facility_access_rate_id' => 'required',
            ], [
                'responsiveness_rate_id.required' => 'This field is required.',
                'reliability_rate_id.required' => 'This field is required.',
                'facility_access_rate_id.required' => 'This field is required.',
            ]);
        }elseif($this->currentStep == 7){
            $this->validate([
                'communication_rate_id' => 'required',
                'cost_rate_id' => 'required_if:availed_service_id,4|required_if:availed_service_id,5|required_if:availed_service_id,6|required_if:availed_service_id,7|required_if:availed_service_id,12|required_if:availed_service_id,28|required_if:availed_service_id,31',
                'integrity_rate_id' => 'required',
            ], [
                'communication_rate_id.required' => 'This field is required.',
                'cost_rate_id.required' => 'This field is required.',
                'integrity_rate_id.required' => 'This field is required.',
            ]);
        }elseif($this->currentStep == 8){
            $this->validate([
                'assurance_rate_id' => 'required',
                'outcome_rate_id' => 'required',
                'overall_rate_id' => 'required',
            ], [
                'assurance_rate_id.required' => 'This field is required.',
                'outcome_rate_id.required' => 'This field is required.',
                'overall_rate_id.required' => 'This field is required.',
            ]);
        }

    }

    public function submit_response(){
        $this->resetErrorBag();

        if( $this->availed_service_id == 4 || $this->availed_service_id == 5 || $this->availed_service_id == 6 || $this->availed_service_id == 7 || $this->availed_service_id == 12 || $this->availed_service_id == 28 || $this->availed_service_id == 31 )
        {
            $cost_rating_value = $this->cost_rate_id;
        } else {
            $cost_rating_value = 6;
        }

        CssResponse::create([
            "status_type_id" => 1,
            "date_accomplished" => Carbon::now()->format('Y-m-d'),
            "client_name" => $this->client_name,
            "sex_type_id" => $this->sex_type_id,
            "region_id" => $this->region_id,
            "contact_details" => $this->contact_details,
            "client_group_id" => $this->client_group_id,
            "client_type_id"=> $this->client_type_id,
            "specify_client_type" => $this->specify_client_type,
            "date_transacted" => $this->date_transacted,
            "transacting_office_id" => $this->transacting_office_id,
            "availed_service_id" => $this->availed_service_id,
            "other_service_availed" => $this->other_service_availed,
            "awareness_response_id" => $this->awareness_response_id,
            "visibility_response_id" => $this->visibility_response_id,
            "helpfulness_response_id" => $this->helpfulness_response_id,
            "responsiveness_rate_id" => $this->responsiveness_rate_id,
            "reliability_rate_id" => $this->reliability_rate_id,
            "facility_access_rate_id" => $this->facility_access_rate_id,
            "communication_rate_id" => $this->communication_rate_id,
            "cost_rate_id" => $cost_rating_value,     
            "integrity_rate_id" => $this->integrity_rate_id,
            "assurance_rate_id" => $this->assurance_rate_id,
            "outcome_rate_id" => $this->outcome_rate_id,
            "overall_rate_id" => $this->overall_rate_id,
            "overall_remarks" => $this->overall_remarks,
        ]);

        $this->reset();
        $this->currentStep = 10;
    }

    public function resetForm(){
        $this->reset();
        $this->currentStep = 1;
    }
}
