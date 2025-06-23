<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">CSM Response</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('module-selector') }}">Module</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('css-results', ['param' => 2024]) }}">Client Satisfaction Measurement</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('list-css-responses') }}">List of CSM Responses</a></li>
                        <li class="breadcrumb-item active">CSM Response</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h3 class="card-title "><i class="fas fa-poll-h mr-2"></i>CSM Response</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12"> 
                                                            <table class="table table-bordered table-xl">
                                                                <tr>
                                                                    <td colspan='2' class="bg-secondary text-white">
                                                                        <strong><i class="fas fa-user mr-1"></i> Personal Information</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width:50%; text-wrap: wrap; vertical-align: top;">Name:</td>
                                                                    <td style="width:50%; text-wrap: wrap; vertical-align: top;">{{ $response_info->client_name ? $response_info->client_name : 'Not Provided' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width:50%; text-wrap: wrap; vertical-align: top;">Sex:</td>
                                                                    <td style="width:50%; text-wrap: wrap; vertical-align: top;">{{ $response_info->sex_type_id > 1 ? 'Female' : 'Male' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width:50%; text-wrap: wrap; vertical-align: top;">Group:</td>
                                                                    <td style="width:50%; text-wrap: wrap; vertical-align: top;">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width:50%; text-wrap: wrap; vertical-align: top;">Client Type:</td>
                                                                    <td style="width:50%; text-wrap: wrap; vertical-align: top;">{{ $response_info->client_type->client_type_name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan='2' class="bg-secondary text-white">
                                                                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width:50%; text-wrap: wrap; vertical-align: top;">Region of Residence:</td>
                                                                    <td style="width:50%; text-wrap: wrap; vertical-align: top;">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan='2' class="bg-secondary text-white">
                                                                        <strong><i class="fas fa-phone mr-1"></i> Contact Details</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width:50%; text-wrap: wrap; vertical-align: top;">Contact no./ Email:</td>
                                                                    <td style="width:50%; text-wrap: wrap; vertical-align: top;">{{ $response_info->contact_details }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan='2' class="bg-secondary text-white">
                                                                        <strong><i class="fas fa-concierge-bell mr-1"></i> Service Details</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width:50%; text-wrap: wrap; vertical-align: top;">Type of Service:</td>
                                                                    <td style="width:50%; text-wrap: wrap; vertical-align: top;">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width:50%; text-wrap: wrap; vertical-align: top;">Transacting Office:</td>
                                                                    <td style="width:50%; text-wrap: wrap; vertical-align: top;">{{ $response_info->transacting_office->transacting_office_name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width:50%; text-wrap: wrap; vertical-align: top;">Service Availed:</td>
                                                                    <td style="width:50%; text-wrap: wrap; vertical-align: top;">{{ $response_info->availed_service->availed_service_name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan='2' class="bg-secondary text-white">
                                                                        <strong><i class="fas fa-hands-helping mr-1"></i> Citizen's Charter</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width:50%; text-wrap: wrap; vertical-align: top;">Awareness:</td>
                                                                    <td style="width:50%; text-wrap: wrap; vertical-align: top;">{{ optional($response_info->awareness)->awareness_response_name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width:50%; text-wrap: wrap; vertical-align: top;">Visibility:</td>
                                                                    <td style="width:50%; text-wrap: wrap; vertical-align: top;">{{ optional($response_info->visibility)->visibility_response_name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width:50%; text-wrap: wrap; vertical-align: top;">Helpfullness:</td>
                                                                    <td style="width:50%; text-wrap: wrap; vertical-align: top;">{{ optional($response_info->helpfulness)->helpfulness_response_name }}</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <table class="table table-bordered table-xl">
                                                        <thead>
                                                            <tr class="bg-secondary text-white">
                                                                <th style="vertical-align: middle; text-align: center">Statements<br>(Service Quality Dimensions)</th>
                                                                <th style="vertical-align: bottom; text-align: center">Very Dissatisfied<br>(1)</th>
                                                                <th style="vertical-align: bottom; text-align: center">Dissatisfied<br>(2)</th>
                                                                <th style="vertical-align: bottom; text-align: center">Neither Satisfied<br>nor Dissatisfied<br>(3)</th>
                                                                <th style="vertical-align: bottom; text-align: center">Satisfied<br>(4)</th>
                                                                <th style="vertical-align: bottom; text-align: center">Very Satisfied<br>(5)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><h6>Responsiveness:</h6><span>I am satisfied with the service that I availed.</span></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->responsiveness_rate_id == 1 ? 'text-danger' : 'text-secondary' }} far fa-dizzy fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->responsiveness_rate_id == 2 ? 'text-danger' : 'text-secondary' }} far fa-frown fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->responsiveness_rate_id == 3 ? 'text-warning' : 'text-secondary' }} far fa-meh fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->responsiveness_rate_id == 4 ? 'text-success' : 'text-secondary' }} far fa-smile fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->responsiveness_rate_id == 5 ? 'text-success' : 'text-secondary' }} far fa-laugh-squint fa-5x"></i></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6>Reliability (Quality):</h6><span>I spent a reasonable amount of time for my transaction.</span></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->reliability_rate_id == 1 ? 'text-danger' : 'text-secondary' }} far fa-dizzy fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->reliability_rate_id == 2 ? 'text-danger' : 'text-secondary' }} far fa-frown fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->reliability_rate_id == 3 ? 'text-warning' : 'text-secondary' }} far fa-meh fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->reliability_rate_id == 4 ? 'text-success' : 'text-secondary' }} far fa-smile fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->reliability_rate_id == 5 ? 'text-success' : 'text-secondary' }} far fa-laugh-squint fa-5x"></i></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6>Access & Facilities:</h6><span>The office followed the transaction’s requirements and steps based on the information provided.</span></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->facility_access_rate_id == 1 ? 'text-danger' : 'text-secondary' }} far fa-dizzy fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->facility_access_rate_id == 2 ? 'text-danger' : 'text-secondary' }} far fa-frown fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->facility_access_rate_id == 3 ? 'text-warning' : 'text-secondary' }} far fa-meh fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->facility_access_rate_id == 4 ? 'text-success' : 'text-secondary' }} far fa-smile fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->facility_access_rate_id == 5 ? 'text-success' : 'text-secondary' }} far fa-laugh-squint fa-5x"></i></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6>Communication:</h6><span>I easily found information about my transaction from the office or its websites.</span></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->communication_rate_id == 1 ? 'text-danger' : 'text-secondary' }} far fa-dizzy fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->communication_rate_id == 2 ? 'text-danger' : 'text-secondary' }} far fa-frown fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->communication_rate_id == 3 ? 'text-warning' : 'text-secondary' }} far fa-meh fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->communication_rate_id == 4 ? 'text-success' : 'text-secondary' }} far fa-smile fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->communication_rate_id == 5 ? 'text-success' : 'text-secondary' }} far fa-laugh-squint fa-5x"></i></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6>Cost:</h6><span>I paid a reasonable amount of fees for my transaction.</span></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->cost_rate_id == 1 ? 'text-danger' : 'text-secondary' }} far fa-dizzy fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->cost_rate_id == 2 ? 'text-danger' : 'text-secondary' }} far fa-frown fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->cost_rate_id == 3 ? 'text-warning' : 'text-secondary' }} far fa-meh fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->cost_rate_id == 4 ? 'text-success' : 'text-secondary' }} far fa-smile fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->cost_rate_id == 5 ? 'text-success' : 'text-secondary' }} far fa-laugh-squint fa-5x"></i></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6>Integrity:</h6><span>I feel the office was fair to everyone, or “walang palakasan”, during my transaction.</span></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->integrity_rate_id == 1 ? 'text-danger' : 'text-secondary' }} far fa-dizzy fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->integrity_rate_id == 2 ? 'text-danger' : 'text-secondary' }} far fa-frown fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->integrity_rate_id == 3 ? 'text-warning' : 'text-secondary' }} far fa-meh fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->integrity_rate_id == 4 ? 'text-success' : 'text-secondary' }} far fa-smile fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->integrity_rate_id == 5 ? 'text-success' : 'text-secondary' }} far fa-laugh-squint fa-5x"></i></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6>Assurance:</h6><span>I was treated courtesy by the staff, and if asked for help, the staff was helpful.</span></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->assurance_rate_id == 1 ? 'text-danger' : 'text-secondary' }} far fa-dizzy fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->assurance_rate_id == 2 ? 'text-danger' : 'text-secondary' }} far fa-frown fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->assurance_rate_id == 3 ? 'text-warning' : 'text-secondary' }} far fa-meh fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->assurance_rate_id == 4 ? 'text-success' : 'text-secondary' }} far fa-smile fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->assurance_rate_id == 5 ? 'text-success' : 'text-secondary' }} far fa-laugh-squint fa-5x"></i></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6>Outcome:</h6><span>I got what I needed from the government office, or (if denied) denial of request was sufficiently explained to me.</span></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->outcome_rate_id == 1 ? 'text-danger' : 'text-secondary' }} far fa-dizzy fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->outcome_rate_id == 2 ? 'text-danger' : 'text-secondary' }} far fa-frown fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->outcome_rate_id == 3 ? 'text-warning' : 'text-secondary' }} far fa-meh fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->outcome_rate_id == 4 ? 'text-success' : 'text-secondary' }} far fa-smile fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->outcome_rate_id == 5 ? 'text-success' : 'text-secondary' }} far fa-laugh-squint fa-5x"></i></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6>Overall:</h6><span>Are you satisfied with the services provided?</span></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->overall_rate_id == 1 ? 'text-danger' : 'text-secondary' }} far fa-dizzy fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->overall_rate_id == 2 ? 'text-danger' : 'text-secondary' }} far fa-frown fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->overall_rate_id == 3 ? 'text-warning' : 'text-secondary' }} far fa-meh fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->overall_rate_id == 4 ? 'text-success' : 'text-secondary' }} far fa-smile fa-5x"></i></td>
                                                                <td style="vertical-align: middle; text-align: center"><i class="{{ $response_info->overall_rate_id == 5 ? 'text-success' : 'text-secondary' }} far fa-laugh-squint fa-5x"></i></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h6>Suggestions:</h6><span>How we can further improve our services?</span></td>
                                                                <td colspan="5" style="vertical-align: middle; text-align: center"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table> 
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
