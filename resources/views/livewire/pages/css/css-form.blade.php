<div>
    <link rel="stylesheet" href="{{ asset('css/css-form.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <div class="form-container">
        <div class="form-card" wire:ignore.self>
            <div class="card-header">
                <h3 class="form-title mb-0">Customer Satisfaction Measurement Form</h3>
            </div>
            <div class="card-body">
                <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: {{ ($currentStep - 1) * 12.5 }}%;" aria-valuenow="{{ ($currentStep - 1) * 12.5 }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <form wire:submit.prevent="submit_response">
                    @csrf
                    <!-- Start -->
                    @if ($currentStep == 1)
                    <div class="start">
                        <div class="text-center">
                            <h4>WELCOME TO PITAHC!</h4>
                            <h6>Help Us Serve You Better!</h6>
                            <p>This Client Satisfaction Measurement (CSM) tracks the customer experience of government offices. Your feedback on your recently concluded transaction will help this office provide a better service. Personal information shared will be kept confidential and you always have option to not answer this form.</p>
                        </div>
                    </div>
                    @endif
                    <!-- Step 1 -->
                    @if ($currentStep == 2)
                    <div class="step-one">
                        <h5>Step 1/8 - Personal Information</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label>Name: <small class="text-muted">(optional)</small></label>
                                    <input type="text" class="form-control form-rounded" placeholder="Juan C. Dela Cruz, Jr." wire:model="client_name">
                                    @error('client_name')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label>Sex: <span class="text-danger fw-bold">*</span></label>
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
                                <div class="form-group mb-3">
                                    <label>Region of Residence: <span class="text-danger fw-bold">*</span></label>
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
                                <div class="form-group mb-3">
                                    <label>Contact number / Email: <small class="text-muted">(optional)</small></label>
                                    <input type="text" class="form-control form-rounded" placeholder="(+63)912-345-6789 / juandelacruz@mail.com" wire:model="contact_details">
                                    @error('contact_details')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- Step 2-->
                    @if ($currentStep == 3)
                    <div class="step-two">
                        <h5>Step 2/8 - Client Details</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label>Client Type: <span class="text-danger fw-bold">*</span></label>
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
                                <div class="form-group mb-3">
                                    <label>I am a: <span class="text-danger fw-bold">*</span></label>
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
                                <div class="form-group mb-3">
                                    <label>Others (please specify): <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" class="form-control form-rounded" placeholder="" wire:model="specify_client_type">
                                    @error('specify_client_type')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- Step 3-->
                    @if ($currentStep == 4)
                    <div class="step-three">
                        <h5>Step 3/8 - Service Availed</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
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
                                <div class="form-group mb-3">
                                    <label>Transacting Office: <span class="text-danger fw-bold">*</span></label>
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
                                <div class="form-group mb-3">
                                    <label>Service Availed: <span class="text-danger fw-bold">*</span></label>
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
                                <div class="form-group mb-3">
                                    <label>Others (please specify): <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" class="form-control form-rounded" placeholder="" wire:model="other_service_availed">
                                    @error('other_service_availed')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- Step 4-->
                    @if ($currentStep == 5)
                    <div class="step-four">
                        <h5>Step 4/8 - Citizen Charter</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label>Awareness: <span class="text-danger fw-bold">*</span></label>
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
                                <div class="form-group mb-3">
                                    <label>Visibility: <span class="text-danger fw-bold">*</span></label>
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
                                <div class="form-group mb-3">
                                    <label>Helfullness: <span class="text-danger fw-bold">*</span></label>
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
                    @endif
                    <!-- Step 5-->
                    @if ($currentStep == 6)
                    <div class="step-five">
                        <h5>Step 5/8 - Rating</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label>Responsiveness: <span class="text-danger fw-bold">*</span></label>
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
                                <div class="form-group mb-3">
                                    <label>Reliability (Quality): <span class="text-danger fw-bold">*</span></label>
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
                                <div class="form-group mb-3">
                                    <label>Access & Facilities: <span class="text-danger fw-bold">*</span></label>
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
                    @endif
                    <!-- Step 6-->
                    @if ($currentStep == 7)
                    <div class="step-five">
                        <h5>Step 6/8 - Rating</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label>Communication: <span class="text-danger fw-bold">*</span></label>
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
                                <div class="form-group mb-3">
                                    <label>Cost: <span class="text-danger fw-bold">*</span></label>
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
                                <div class="form-group mb-3">
                                    <label>Integrity: <span class="text-danger fw-bold">*</span></label>
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
                    @endif
                    <!-- Step 7-->
                    @if ($currentStep == 8)
                    <div class="step-five">
                        <h5>Step 7/8 - Rating</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label>Assurance: <span class="text-danger fw-bold">*</span></label>
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
                                <div class="form-group mb-3">
                                    <label>Outcome: <span class="text-danger fw-bold">*</span></label>
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
                                <div class="form-group mb-3">
                                    <label>Overall: <span class="text-danger fw-bold">*</span></label>
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
                    @endif
                    <!-- Step 8-->
                    @if ($currentStep == 9)
                    <div class="step-two">
                        <h5>Step 8/8 - Suggestions and Reccommendations</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label>Suggestions on how we can further improve our services: <small class="text-muted">(optional)</small></label>
                                    <textarea class="form-control form-rounded" rows="4" wire:model="overall_remarks"></textarea>
                                    @error('overall_remarks')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- End-->
                    @if ($currentStep == 10)
                    <div class="end">
                        <div class="text-center">
                            <h4>WE HOPE TO SEE YOU AGAIN!</h4>
                            <h6>Thank you!</h6>
                        </div>
                    </div>
                    @endif

                    <div class="mt-4">
                        @if ($currentStep == 1)
                        <div class="d-grid">
                            <button class="btn btn-success btn-lg" type="button" wire:click="increaseStep()"><i class="fas fa-play mr-2"></i>Click here to start!</button>
                        </div>
                        @endif

                        @if ($currentStep > 1 && $currentStep < 10)
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-secondary btn-lg" type="button" wire:click.prevent="decreaseStep()"><i class="fas fa-arrow-left mr-2"></i>Back</button>
                            @if ($currentStep < 9)
                            <button class="btn btn-success btn-lg" type="button" wire:click.prevent="increaseStep()">Next<i class="fas fa-arrow-right ml-2"></i></button>
                            @endif
                            @if ($currentStep == 9)
                            <button class="btn btn-success btn-lg" type="submit"><i class="fas fa-check mr-2"></i>Submit</button>
                            @endif
                        </div>
                        @endif

                        @if ($currentStep == 10)
                        <div class="d-grid">
                            <button class="btn btn-success btn-lg" type="button" wire:click.prevent="resetForm()"><i class="fas fa-redo mr-2"></i>Submit another response?</button>
                        </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
