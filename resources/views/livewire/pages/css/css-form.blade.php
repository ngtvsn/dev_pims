<div>
    <style type="text/css">
    body {
    background-image: -webkit-radial-gradient(center, circle cover, #59b459, #59b459 90%);
    background-image: -moz-radial-gradient(center, circle cover, #59b459, #59b459 80%);
    background-image: -o-radial-gradient(center, circle cover, #59b459, #59b459 80%);
    background-image: radial-gradient(center, circle cover, #59b459, #59b459 80%); 
    }
    #content1 {                                
    width: 100%;
    height: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
        animation: zoom 15s forwards;
    }
    @keyframes zoom {
        0% {
            transform: scale(1,1);
        }
        50% {
            transform: scale(1.2,1.2);
        }
        100% {
            transform: scale(1,1);
        }
    }
    .bg {
    animation:slide 3s ease-in-out infinite alternate;
    background-image: linear-gradient(-60deg, #ffce29 50%, #741299 50%);
    bottom:0;
    left:-50%;
    opacity:.1;
    position:fixed;
    right:-50%;
    top:0;
    z-index:-1;
    }
    .bg2 {
    animation-direction:alternate-reverse;
    animation-duration:4s;
    }
    .bg3 {
    animation-duration:5s;
    }
    h1 {
    font-family:monospace;
    }
    @keyframes slide {
    0% {
        transform:translateX(-25%);
    }
    100% {
        transform:translateX(25%);
    }
    }
    .content {
    background-image: -webkit-radial-gradient(top, circle cover, #ffffff, #ffce29 90%);
    border-radius:.90em;
    box-shadow:0 0 .25em rgba(0,0,0,.25);
    box-sizing:border-box;
    left:50%;
    padding:4vmin;
    position:fixed;    
    top:50%;
    transform:translate(-50%, -50%);
    border:1px solid red;
    }
    h3 {
    color:#000000;    
    }
    input {
    text-indent: 5px;
    }
    .form-rounded {
    border-radius: 2rem;
    }

    </style>    
    
    <div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>

    <div class="container" wire:ignore.self>
        <div class="row mt-5">
            <div class="col-md-8 offset-2">
                <div class="card">
                    <h3 class="text-center py-3 mx-2 my-2">Customer Satisfaction Measurement Form</h3>
                    <div>
                        <form wire:submit.prevent="submit_response">
                        @csrf
                            <!-- Start -->
                            @if ($currentStep == 1)
                            <div class="start">
                                <div class="card mx-2 my-2">
                                    <div class="card-header bg-success">WELCOME TO PITAHC!</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h6>Help Us Serve You Better!</h6>
                                                <p>This Client Satisfaction Measurement (CSM) tracks the customer experience of government offices. Your feedback on your recently concluded transaction will help this office provide a better service. Personal information shared will be kept confidential and you always have option to not answer this form.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <!-- Step 1 -->
                            @if ($currentStep == 2)
                            <div class="step-one">
                                <div class="card mx-2 my-2">
                                    <div class="card-header bg-success">Step 1/8 - Personal Information</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Name:</label><small class="text-muted ml-1">(optional)</small>
                                                    <input type="text" class="form-control form-rounded" placeholder="Juan C. Dela Cruz, Jr." wire:model="client_name">
                                                    @error('client_name')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Sex:</label><span class="text-danger ml-1" style="font-weight:bold;">*</span>
                                                    <select class="form-control form-rounded" wire:model="sex_type_id">
                                                        <option value="" selected>Please select</option>
                                                        @foreach( $sex_types as $sex_type )
                                                        <option value="{{ $sex_type->id }}">{{ $sex_type->sex_type_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('sex_type_id')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Region of Residence:</label><span class="text-danger ml-1" style="font-weight:bold;">*</span>
                                                    <select class="form-control form-rounded" wire:model="region_id">
                                                        <option value="" selected>Please select</option>
                                                        @foreach( $regions as $region )
                                                        <option value="{{ $region->id }}">{{ $region->region_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('region_id')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Contact number / Email:</label><small class="text-muted ml-1">(optional)</small>
                                                    <input type="text" class="form-control form-rounded" placeholder="(+63)912-345-6789 / juandelacruz@mail.com" wire:model="contact_details">
                                                    @error('contact_details')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <!-- Step 2-->
                            @if ($currentStep == 3)
                            <div class="step-two">
                                <div class="card mx-2 my-2">
                                    <div class="card-header bg-success">Step 2/8 - Client Details</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Client Type:</label><span class="text-danger ml-1" style="font-weight:bold;">*</span>
                                                    <select class="form-control form-rounded" wire:model="client_group_id">
                                                        <option value="" selected>Please select</option>
                                                        @foreach( $client_groups as $client_group )
                                                        <option value="{{ $client_group->id }}">{{ $client_group->client_group_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('client_group_id')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>I am a:</label><span class="text-danger ml-1" style="font-weight:bold;">*</span>
                                                    <select class="form-control form-rounded" wire:model="client_type_id">
                                                        <option value="" selected>Please select</option>
                                                        @foreach( $client_types as $client_type )
                                                        <option value="{{ $client_type->id }}">{{ $client_type->client_type_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('client_type_id')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @if ($client_type_id == 7)
                                                <div class="form-group">
                                                    <label>Others (please specify):</label>
                                                        <span class="text-danger ml-1" style="font-weight:bold;">*</span>
                                                    <input type="text" class="form-control form-rounded" placeholder="" wire:model="specify_client_type">
                                                    @error('specify_client_type')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <!-- Step 3-->
                            @if ($currentStep == 4)
                            <div class="step-three">
                                <div class="card mx-2 my-2">
                                    <div class="card-header bg-success">Step 3/8 - Service Availed</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Transaction Date:</label>
                                                    @php
                                                        $currentYear = date('Y');
                                                        $firstDayOfYear = $currentYear-1 . '-01-01';
                                                        $today = date('Y-m-d');
                                                    @endphp
                                                    <input id="date_transacted" type="date" class="form-control form-rounded" placeholder="mm/dd/yyyy" min="{{ $firstDayOfYear }}" max="{{ $today }}" wire:model="date_transacted">
                                                    @error('date_transacted')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Transacting Office:</label><span class="text-danger ml-1" style="font-weight:bold;">*</span>
                                                    <select class="form-control form-rounded" wire:model="transacting_office_id">
                                                        <option value="" selected>Please select</option>
                                                        @foreach( $transacting_offices as $transacting_office )
                                                        <option value="{{ $transacting_office->id }}">{{ $transacting_office->transacting_office_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('transacting_office_id')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Service Availed:</label><span class="text-danger ml-1" style="font-weight:bold;">*</span>
                                                    <select class="form-control form-rounded" wire:model="availed_service_id">
                                                        <option value="" selected>Please select</option>
                                                        @foreach( $availed_services as $availed_service )
                                                        <option value="{{ $availed_service->id }}">{{ $availed_service->availed_service_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('availed_service_id')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @if ($availed_service_id == 33)
                                                <div class="form-group">
                                                    <label>Others (please specify):</label>
                                                    <span class="text-danger ml-1" style="font-weight:bold;">*</span>
                                                    <input type="text" class="form-control form-rounded" placeholder="" wire:model="other_service_availed">
                                                    @error('other_service_availed')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <!-- Step 4-->
                            @if ($currentStep == 5)
                            <div class="step-four">
                                <div class="card mx-2 my-2">
                                    <div class="card-header bg-success">Step 4/8 - Citizen Charter</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Awareness:</label><span class="text-danger ml-1" style="font-weight:bold;">*</span>
                                                    <p>Which of the following best describes your awareness of a Citizen Charter?</p>
                                                    <select class="form-control form-rounded" wire:model="awareness_response_id">
                                                        <option value="" selected>Please select</option>
                                                        @foreach( $awareness_responses as $awareness_response )
                                                        <option value="{{ $awareness_response->id }}">{{ $awareness_response->awareness_response_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('awareness_response_id')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @if ($awareness_response_id < 4 && isset($awareness_response_id))
                                                <div class="form-group">
                                                    <label>Visibility:</label><span class="text-danger ml-1" style="font-weight:bold;">*</span>
                                                    <p>If aware of Citizen Charter, would you say that the Citizen Charter of this office was ...?</p>
                                                    <select class="form-control form-rounded" wire:model="visibility_response_id">
                                                        <option value="" selected>Please select</option>
                                                        @foreach( $visibility_responses as $visibility_response )
                                                        <option value="{{ $visibility_response->id }}">{{ $visibility_response->visibility_response_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('visibility_response_id')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Helfullness:</label><span class="text-danger ml-1" style="font-weight:bold;">*</span>
                                                    <p>If aware of Citizen Charter, how much did the Citizen Charter help you in your transaction?</p>
                                                    <select class="form-control form-rounded" wire:model="helpfulness_response_id">
                                                        <option value="" selected>Please select</option>
                                                        @foreach( $helpfulness_responses as $helpfulness_response )
                                                        <option value="{{ $helpfulness_response->id }}">{{ $helpfulness_response->helpfulness_response_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('helpfulness_response_id')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <!-- Step 5-->
                            @if ($currentStep == 6)
                            <div class="step-five">
                                <div class="card mx-2 my-2">
                                    <div class="card-header bg-success">Step 5/8 - Rating</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Responsiveness:</label><span class="text-danger ml-1" style="font-weight:bold;">*</span>
                                                    <p>I am satisfied with the service that I availed</p>
                                                    <select class="form-control form-rounded" wire:model="responsiveness_rate_id">
                                                        <option value="" selected>Please select</option>
                                                        @foreach( $ratings as $rating )
                                                        <option value="{{ $rating->id }}">{{ $rating->id }} - {{ $rating->rating_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('responsiveness_rate_id')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Reliability (Quality):</label><span class="text-danger ml-1" style="font-weight:bold;">*</span>
                                                    <p>I spent a reasonable amount of time for my transaction</p>
                                                    <select class="form-control form-rounded" wire:model="reliability_rate_id">
                                                        <option value="" selected>Please select</option>
                                                        @foreach( $ratings as $rating )
                                                        <option value="{{ $rating->id }}">{{ $rating->id }} - {{ $rating->rating_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('reliability_rate_id')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Access & Facilities:</label><span class="text-danger ml-1" style="font-weight:bold;">*</span>
                                                    <p>The office followed the transaction’s requirements and steps based on the information provided</p>
                                                    <select class="form-control form-rounded" wire:model="facility_access_rate_id">
                                                        <option value="" selected>Please select</option>
                                                        @foreach( $ratings as $rating )
                                                        <option value="{{ $rating->id }}">{{ $rating->id }} - {{ $rating->rating_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('facility_access_rate_id')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <!-- Step 6-->
                            @if ($currentStep == 7)
                            <div class="step-five">
                                <div class="card mx-2 my-2">
                                    <div class="card-header bg-success">Step 6/8 - Rating</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Communication:</label><span class="text-danger ml-1" style="font-weight:bold;">*</span>
                                                    <p>I easily found information about my transaction from the office or its websites</p>
                                                    <select class="form-control form-rounded" wire:model="communication_rate_id">
                                                        <option value="" selected>Please select</option>
                                                        @foreach( $ratings as $rating )
                                                        <option value="{{ $rating->id }}">{{ $rating->id }} - {{ $rating->rating_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('communication_rate_id')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @if( $availed_service_id == 4 || $availed_service_id == 5 || $availed_service_id == 6 || $availed_service_id == 7 || $availed_service_id == 12 || $availed_service_id == 28 || $availed_service_id == 31 )
                                                <div class="form-group">
                                                    <label>Cost:</label><span class="text-danger ml-1" style="font-weight:bold;">*</span>
                                                    <p>I paid a reasonable amount of fees for my transaction</p>
                                                    <select class="form-control form-rounded" wire:model="cost_rate_id">
                                                        <option value="" selected>Please select</option>
                                                        @foreach( $ratings as $rating )
                                                        <option value="{{ $rating->id }}">{{ $rating->id }} - {{ $rating->rating_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('cost_rate_id')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @endif
                                                <div class="form-group">
                                                    <label>Integrity:</label><span class="text-danger ml-1" style="font-weight:bold;">*</span>
                                                    <p>I feel the office was fair to everyone, or “walang palakasan”, during my transaction</p>
                                                    <select class="form-control form-rounded" wire:model="integrity_rate_id">
                                                        <option value="" selected>Please select</option>
                                                        @foreach( $ratings as $rating )
                                                        <option value="{{ $rating->id }}">{{ $rating->id }} - {{ $rating->rating_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('integrity_rate_id')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <!-- Step 7-->
                            @if ($currentStep == 8)
                            <div class="step-five">
                                <div class="card mx-2 my-2">
                                    <div class="card-header bg-success">Step 7/8 - Rating</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Assurance:</label><span class="text-danger ml-1" style="font-weight:bold;">*</span>
                                                    <p>I was treated courtesy by the staff, and if asked for help) the staff was helpful</p>
                                                    <select class="form-control form-rounded" wire:model="assurance_rate_id">
                                                        <option value="" selected>Please select</option>
                                                        @foreach( $ratings as $rating )
                                                        <option value="{{ $rating->id }}">{{ $rating->id }} - {{ $rating->rating_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('assurance_rate_id')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Outcome:</label><span class="text-danger ml-1" style="font-weight:bold;">*</span>
                                                    <p>I got what I needed from the government office, or (if denied) denial of request was sufficiently explained to me</p>
                                                    <select class="form-control form-rounded" wire:model="outcome_rate_id">
                                                        <option value="" selected>Please select</option>
                                                        @foreach( $ratings as $rating )
                                                        <option value="{{ $rating->id }}">{{ $rating->id }} - {{ $rating->rating_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('outcome_rate_id')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Overall:</label><span class="text-danger ml-1" style="font-weight:bold;">*</span>
                                                    <p>Are you satisfied with the services provided?</p>
                                                    <select class="form-control form-rounded" wire:model="overall_rate_id">
                                                        <option value="" selected>Please select</option>
                                                        @foreach( $ratings as $rating )
                                                        <option value="{{ $rating->id }}">{{ $rating->id }} - {{ $rating->rating_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('overall_rate_id')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <!-- Step 8-->
                            @if ($currentStep == 9)
                            <div class="step-two">
                                <div class="card mx-2 my-2">
                                    <div class="card-header bg-success">Step 8/8 - Suggestions and Reccommendations</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Suggestions on how we can further improve our services:</label><small class="text-muted ml-1">(optional)</small>
                                                    <textarea class="form-control form-rounded" rows="4" wire:model="overall_remarks"></textarea>
                                                    @error('overall_remarks')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <!-- End-->
                            @if ($currentStep == 10)
                            <div class="end">
                                <div class="card">
                                    <div class="card-header bg-success">WE HOPE TO SEE YOU AGAIN!</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h6>Thank you!</h6>
                                                <p>For urgent concern, feel free to talk our Officer-of-the-Day in the lobby.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="mx-2 my-2">

                                @if ($currentStep == 1)
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-success btn-lg btn-block" type="button" wire:click="increaseStep()"><i class="fas fa-grin-stars mr-2"></i>Click here to start!</button>
                                    </div>
                                </div>
                                @endif

                                @if ($currentStep == 2 || $currentStep == 3 || $currentStep == 4 || $currentStep == 5 || $currentStep == 6 || $currentStep == 7 || $currentStep == 8)
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-secondary btn-lg btn-block" type="button" wire:click.prevent="decreaseStep()"><i class="fas fa-angle-left mr-2"></i>Back</button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-success btn-lg btn-block" type="button" wire:click.prevent="increaseStep()">Next<i class="fas fa-angle-right ml-2"></i></button>
                                    </div>
                                </div>
                                @endif

                                @if ($currentStep == 9)
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-secondary btn-lg btn-block" type="button" wire:click.prevent="decreaseStep()"><i class="fas fa-angle-left mr-2"></i>Back</button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-success btn-lg btn-block" type="submit"><i class="fas fa-paper-plane mr-2"></i>Submit</button>
                                    </div>
                                </div>
                                @endif

                                @if ($currentStep == 10)
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-success btn-lg btn-block" type="button" wire:click.prevent="resetForm()"><i class="fas fa-history mr-2"></i>Submit another response?</button>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>