<div>    
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">ICT Requests</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('module-selector') }}">Modules</a></li>
                            <li class="breadcrumb-item active">ICT Requests</li>
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
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-filter mr-2"></i>Filter</h3>
                            </div>
                            <div class="card-body">
                                <div>
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                                                </div>
                                                <input type="search" wire:model.debounce.500ms="search" class="form-control" placeholder="Search by ...." aria-label="search" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-content-center">
                                        <div class="d-flex">
                                            <div>
                                                <div class="form-group">
                                                    <label style="white-space: nowrap;">Per Page</label>
                                                    <select wire:model="paginate" name="paginate" id="paginate" class="form-control">
                                                        <option value="10">10</option>
                                                        <option value="20">20</option>
                                                        <option value="30">30</option>
                                                        <option value="40">40</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <div class="form-group">
                                                    <label>Request Status</label>
                                                    <select class="form-control" wire:model="SelectedRequestStatusType">
                                                        <option value="">Please Select</option>
                                                        @foreach( $request_status_types as $request_status_type )
                                                        <option value="{{ $request_status_type->id }}">{{ $request_status_type->request_status_type_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <div class="form-group">
                                                    <label>Request Type</label>
                                                    <select class="form-control" wire:model="SelectedRequestType">
                                                        <option value="">Please Select</option>
                                                        @foreach( $request_types as $request_type )
                                                        <option value="{{ $request_type->id }}">{{ $request_type->request_type_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <div class="form-group">
                                                    <label>Sub Request Type</label>
                                                    <select class="form-control" wire:model="SelectedSubRequestType">
                                                        <option value="">Please Select</option>
                                                        @foreach( $sub_request_types as $sub_request_type )
                                                        <option value="{{ $sub_request_type->id }}">{{ $sub_request_type->sub_request_type_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-2">
                                <button id="add_button" type="button" class="btn btn-primary float-right ml-2" wire:click.prevent="AddIctRequestForm()" data-keyboard="false"><i class="fa fa-plus mr-2"></i>Add ICT Request</button>
                                <button id="clear_filter" type="button" class="btn btn-secondary float-right" wire:click.prevent="ClearFilter()" data-keyboard="false"><i class="fas fa-redo-alt mr-2"></i>Clear Filter</button>
                            </div>
                        </div>
                        <div class="card" wire:poll.5s>
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-folder mr-2"></i>List ICT Requests</h3>
                            </div>
                            <div class="card-body">
                                <div>
                                    @if ($checked)
                                    <div class="d-flex justify-content-between align-content-center mb-2">   
                                        <div class="d-flex">
                                            <div>
                                                <div class="dropdown ml-4">
                                                    <button class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">With Checked
                                                        ({{ count($checked) }})</button>
                                                    <div class="dropdown-menu">
                                                        <!-- <a href="#" class="dropdown-item" type="button"
                                                            onclick="confirm('Are you sure you want to delete these Records?') || event.stopImmediatePropagation()"
                                                            wire:click="deleteRecords()">
                                                            Delete
                                                        </a> -->
                                                        <a href="#" class="dropdown-item" type="button"
                                                            onclick="confirm('Are you sure you want to export these Records?') || event.stopImmediatePropagation()"
                                                            wire:click="exportSelected()">
                                                            Export
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if ($selectPage)
                                    <div class="col-md-10 mb-2">
                                        @if ($selectAll)
                                        <div>
                                            You have selected all <strong>{{ $ict_requests->total() }}</strong> items.
                                        </div>
                                        @else
                                        <div>
                                            You have selected <strong>{{ count($checked) }}</strong> items, Do you want to Select All
                                            <strong>{{ $ict_requests->total() }}</strong>?
                                            <a href="#" class="ml-2" wire:click="selectAll">Select All</a>
                                        </div>
                                        @endif
                                    </div>
                                    @endif
                                    <div class="card-body table-responsive p-0">
                                        @if($ict_requests->isEmpty())
                                        <div class="text-center p-3">
                                            <p>No results found for the search.</p>
                                        </div>
                                        @else
                                        <table class="table table-hover table-sm">
                                            <tr>
                                                <th style="vertical-align: middle; text-align: center"><input type="checkbox" wire:model="selectPage"></th>
                                                <th style="vertical-align: middle; text-align: center">Actions</th>
                                                <th style="vertical-align: middle; text-align: center">Status</th>
                                                <th style="vertical-align: middle; text-align: center">Ticket no.</th>
                                                <th style="vertical-align: middle; text-align: center">Requestor Name</th>
                                                <th style="vertical-align: middle; text-align: center">Request Type</th>
                                                <th style="vertical-align: middle; text-align: center">Sub Request Type</th>
                                                <th style="vertical-align: middle; text-align: center">Request Details</th>
                                                <th style="vertical-align: middle; text-align: center">Created at</th>
                                                <th style="vertical-align: middle; text-align: center">Updated at</th>
                                            </tr>
                                            @foreach( $ict_requests as $ict_request )
                                            <tr class="@if ($this->isChecked($ict_request->id)) table-primary @else  @endif">
                                                <td style="vertical-align: middle; text-align: center"><input type="checkbox" value="{{ $ict_request->id }}" wire:model="checked"></td>
                                                <td style="vertical-align: middle;">
                                                    <div style="white-space: nowrap">
                                                        @if( Auth::user()->userlevel_id == 1 )
                                                        <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete" wire:click.prevent="DeleteForm( {{ $ict_request->id }} )">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        @endif
                                                        @if( $ict_request->created_by == Auth::user()->id && $ict_request->request_status_type_id == 1 )
                                                        <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Cancel ICT Request" wire:click.prevent="CancelIctRequestForm( {{ $ict_request->id }} )">
                                                            <i class="fas fa-stop"></i>
                                                        </button>
                                                        @endif
                                                        @if( Auth::user()->userlevel_id == 1 && $ict_request->request_status_type_id == 1)
                                                        <button class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Start" wire:click.prevent="StartRequestForm( {{ $ict_request->id }} )">
                                                            <i class="fas fa-play"></i>
                                                        </button>
                                                        @endif
                                                        @if( $ict_request->technical_support_representative_id == Auth::user()->id && $ict_request->request_status_type_id == 2)
                                                        <button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Resolve" wire:click.prevent="ResolveRequestForm( {{ $ict_request->id }} )">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                        @endif
                                                        @if( $ict_request->created_by == Auth::user()->id && $ict_request->request_status_type_id == 3)
                                                        <button class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Close" wire:click.prevent="CloseRequestForm( {{ $ict_request->id }} )">
                                                            <i class="fas fa-check-double"></i>
                                                        </button>
                                                        @endif
                                                    </div>
                                                </td>
                                                @if( $ict_request->request_status_type_id==1 )    
                                                <td style="vertical-align: middle; text-align: center"><span class="badge badge-warning" style="display: block; width: 100%;">Pending</span></td>
                                                @elseif( $ict_request->request_status_type_id==2 )    
                                                <td style="vertical-align: middle; text-align: center"><span class="badge badge-info" style="display: block; width: 100%;">In Progress</span></td>
                                                @elseif( $ict_request->request_status_type_id==3 )    
                                                <td style="vertical-align: middle; text-align: center"><span class="badge badge-success" style="display: block; width: 100%;">Resolved</span></td>
                                                @elseif( $ict_request->request_status_type_id==4 )    
                                                <td style="vertical-align: middle; text-align: center"><span class="badge badge-secondary" style="display: block; width: 100%;">Closed</span></td>
                                                @elseif( $ict_request->request_status_type_id==5 )   
                                                <td style="vertical-align: middle; text-align: center"><span class="badge badge-danger" style="display: block; width: 100%;">Cancelled</span></td>
                                                @endif  
                                                <td style="vertical-align: middle; text-align: center">{{ $ict_request->ticket_no }}</td>
                                                <td style="vertical-align: middle; text-align: center; white-space: nowrap;">{{ optional($ict_request->user_created)->last_name }}, {{ optional($ict_request->user_created)->first_name }} {{ optional($ict_request->user_created)->middle_name }}</td>
                                                <td style="vertical-align: middle; text-align: center;">{{ optional($ict_request->request_type)->request_type_name }}</td>
                                                <td style="vertical-align: middle; text-align: center;">{{ optional($ict_request->sub_request_type)->sub_request_type_name }}</td>
                                                <td style="vertical-align: middle; text-align: center;">{{ $ict_request->request_details }}</td>
                                                <td style="vertical-align: middle; text-align: center;">
                                                    <span style="color:#1876f2;"><small>{{ $ict_request->created_at->diffForHumans() }}</small></span>
                                                </td>
                                                <td style="vertical-align: middle; text-align: center;">
                                                    <span style="color:#1876f2;"><small>{{ $ict_request->updated_at->diffForHumans() }}</small></span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                        @endif
                                    </div>
                                    <div class="row mt-4">
                                        <div class="d-flex justify-content-center">
                                            {{ $ict_requests->links() }}
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
    <div class="modal fade" id="add-ict-request-form" wire:ignore.self>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form autocomplete="off" wire:submit.prevent="AddIctRequest">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <span><i class="fas fa-robot mr-2"></i>ICT Service Request</span><span class="badge badge-warning ml-2">PENDING</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group" id="div_created_at" wire:ignore.self>
                                            <label>Date Time Requested:</label>
                                            @php
                                                use Carbon\Carbon;
                                                $now = Carbon::now()->format('F d, Y - h:i A');
                                                $current_year = Carbon::now()->format('Y');
                                            @endphp
                                            <input id="created_at" type="text" class="form-control" value="{{ $now }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group" id="div_ticket_no" wire:ignore.self>
                                            <label>Ticket no. :</label>
                                            <input id="ticket_no" type="text" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div style="display: flex; align-items: center; ">
                                            <i class="fas fa-user mr-2"></i>
                                            <h6 class="mr-2">Requestor Details</h6>
                                            <hr style="flex-grow: 1; border: none; border-top: 1px solid #e9ecef;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group" id="div_last_name" wire:ignore.self>
                                            <label>Last name:</label>
                                            <input type="text" class="form-control" id="last_name" value="{{ Auth::user()->last_name }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group" id="div_first_name" wire:ignore.self>
                                            <label>First name:</label>
                                            <input type="text" class="form-control" id="first_name" value="{{ Auth::user()->first_name }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group" id="div_middle_name" wire:ignore.self>
                                            <label>Middle name:</label>
                                            <input type="text" class="form-control" id="middle_name" value="{{ Auth::user()->middle_name }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-7">
                                        <div class="form-group" id="div_office_name" wire:ignore.self>
                                            <label>Office:</label>
                                            <input type="text" class="form-control" id="office_name" value="{{ optional(Auth::user()->office)->office_name }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group" id="div_division_name" wire:ignore.self>
                                            <label>Division:</label>
                                            <input type="text" class="form-control" id="division_name" value="{{ optional(Auth::user()->division)->division_name }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group" id="div_position_name" wire:ignore.self>
                                            <label>Position:</label>
                                            <input type="text" class="form-control" id="position_name" value="{{ optional(Auth::user()->position)->position_name }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group" id="div_local" wire:ignore.self>
                                            <label>Local:</label>
                                            <input type="text" class="form-control" id="local" value="{{ Auth::user()->local }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group" id="div_email" wire:ignore.self>
                                            <label>Email Address:</label>
                                            <input type="text" class="form-control" id="email" value="{{ Auth::user()->email }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div style="display: flex; align-items: center;">
                                            <i class="fab fa-readme mr-2"></i>
                                            <h6 class="mr-2">Request Details</h6>
                                            <hr style="flex-grow: 1; border: none; border-top: 1px solid #e9ecef;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group" id="div_request_type_id" wire:ignore.self>
                                                    <label>Request Type:</label><span class="text-danger" style="font-weight:bold;"> *</span>
                                                    <select class="form-control custom-select" name="request_type_id" id="request_type_id" wire:model="request_type_id">
                                                    <option value="">Please Select</option>
                                                    @foreach( $request_types as $request_type )
                                                    <option value="{{ $request_type->id }}">{{ $request_type->request_type_name }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                @error('request_type_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group" id="div_sub_request_type_id" wire:ignore.self>
                                                    <label>Sub Request Type:</label><span class="text-danger" style="font-weight:bold;"> *</span>
                                                    <select class="form-control custom-select" name="sub_request_type_id" id="sub_request_type_id" wire:model.defer="sub_request_type_id">
                                                    <option value="">Please Select</option>
                                                    @foreach( $form_sub_request_types as $form_sub_request_type )
                                                    <option value="{{ $form_sub_request_type->id }}">{{ $form_sub_request_type->sub_request_type_name }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                @error('sub_request_type_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group" id="div_request_details" wire:ignore.self>
                                                    <label>Request Description:</label><span class="text-danger" style="font-weight:bold;"> *</span>
                                                    <textarea class="form-control" id="request_details" rows="5" wire:model.defer="request_details"></textarea>
                                                </div>
                                                @error('request_details')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>    
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="mr-auto" style="font-weight: bold; font-style: italic"><span class="text-danger mr-2">*</span>Fields with red asterisk are required.</span>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <span><i class="fa fa-ban mr-2"></i>Cancel</span>
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <span><i class="fa fa-plus mr-2"></i>Add</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="start-request-form" wire:ignore.self>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form autocomplete="off" wire:submit.prevent="StartRequest">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <span><i class="fas fa-robot mr-2"></i>ICT Service Request</span><span class="badge badge-warning ml-2">Pending</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group" id="div_created_at" wire:ignore.self>
                                            <label>Date Time Requested:</label>
                                            <input id="created_at" type="text" class="form-control" wire:model.defer="created_at" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group" id="div_ticket_no" wire:ignore.self>
                                            <label>Ticket no. :</label>
                                            <input id="ticket_no" type="text" class="form-control" wire:model.defer="ticket_no" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div style="display: flex; align-items: center; ">
                                            <i class="fas fa-user mr-2"></i>
                                            <h6 class="mr-2">Requestor Details</h6>
                                            <hr style="flex-grow: 1; border: none; border-top: 1px solid #e9ecef;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group" id="div_last_name" wire:ignore.self>
                                            <label>Last name:</label>
                                            <input type="text" class="form-control" id="last_name" wire:model.defer="last_name" disabled>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group" id="div_first_name" wire:ignore.self>
                                            <label>First name:</label>
                                            <input type="text" class="form-control" id="first_name" wire:model.defer="first_name" disabled>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group" id="div_middle_name" wire:ignore.self>
                                            <label>Middle name:</label>
                                            <input type="text" class="form-control" id="middle_name" wire:model.defer="middle_name" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-7">
                                        <div class="form-group" id="div_office_name" wire:ignore.self>
                                            <label>Office:</label>
                                            <input type="text" class="form-control" id="office_name" wire:model.defer="office_name" disabled>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group" id="div_division_name" wire:ignore.self>
                                            <label>Division:</label>
                                            <input type="text" class="form-control" id="division_name" wire:model.defer="division_name" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group" id="div_position_name" wire:ignore.self>
                                            <label>Position:</label>
                                            <input type="text" class="form-control" id="position_name" wire:model.defer="position_name" disabled>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group" id="div_local" wire:ignore.self>
                                            <label>Local:</label>
                                            <input type="text" class="form-control" id="local" wire:model.defer="local" disabled>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group" id="div_email" wire:ignore.self>
                                            <label>Email Address:</label>
                                            <input type="text" class="form-control" id="email" wire:model.defer="email" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div style="display: flex; align-items: center;">
                                            <i class="fab fa-readme mr-2"></i>
                                            <h6 class="mr-2">Request Details</h6>
                                            <hr style="flex-grow: 1; border: none; border-top: 1px solid #e9ecef;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group" id="div_request_type_id" wire:ignore.self>
                                                    <label>Request Type:</label>
                                                    <select class="form-control custom-select" name="request_type_id" id="request_type_id" wire:model="request_type_id" disabled>
                                                    <option value="">Please Select</option>
                                                    @foreach( $request_types as $request_type )
                                                    <option value="{{ $request_type->id }}">{{ $request_type->request_type_name }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                @error('request_type_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group" id="div_sub_request_type_id" wire:ignore.self>
                                                    <label>Sub Request Type:</label>
                                                    <select class="form-control custom-select" name="sub_request_type_id" id="sub_request_type_id" wire:model.defer="sub_request_type_id" disabled>
                                                    <option value="">Please Select</option>
                                                    @foreach( $form_sub_request_types as $form_sub_request_type )
                                                    <option value="{{ $form_sub_request_type->id }}">{{ $form_sub_request_type->sub_request_type_name }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                @error('sub_request_type_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group" id="div_request_details" wire:ignore.self>
                                                    <label>Request Description:</label>
                                                    <textarea class="form-control" id="request_details" rows="5" wire:model.defer="request_details" disabled></textarea>
                                                </div>
                                                @error('request_details')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>    
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <span><i class="fa fa-ban mr-2"></i>Cancel</span>
                        </button>
                        <button type="submit" class="btn btn-info">
                            <span><i class="fas fa-play mr-2"></i>Start</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="resolve-request-form" wire:ignore.self>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form autocomplete="off" wire:submit.prevent="ResolveRequest">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <span><i class="fas fa-robot mr-2"></i>ICT Service Request</span><span class="badge badge-info ml-2">In progress</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group" id="div_created_at" wire:ignore.self>
                                            <label>Date Time Requested:</label>
                                            <input id="created_at" type="text" class="form-control" wire:model.defer="created_at" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group" id="div_ticket_no" wire:ignore.self>
                                            <label>Ticket no. :</label>
                                            <input id="ticket_no" type="text" class="form-control" wire:model.defer="ticket_no" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div style="display: flex; align-items: center; ">
                                            <i class="fas fa-user mr-2"></i>
                                            <h6 class="mr-2">Requestor Details</h6>
                                            <hr style="flex-grow: 1; border: none; border-top: 1px solid #e9ecef;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group" id="div_last_name" wire:ignore.self>
                                            <label>Last name:</label>
                                            <input type="text" class="form-control" id="last_name" wire:model.defer="last_name" disabled>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group" id="div_first_name" wire:ignore.self>
                                            <label>First name:</label>
                                            <input type="text" class="form-control" id="first_name" wire:model.defer="first_name" disabled>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group" id="div_middle_name" wire:ignore.self>
                                            <label>Middle name:</label>
                                            <input type="text" class="form-control" id="middle_name" wire:model.defer="middle_name" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-7">
                                        <div class="form-group" id="div_office_name" wire:ignore.self>
                                            <label>Office:</label>
                                            <input type="text" class="form-control" id="office_name" wire:model.defer="office_name" disabled>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group" id="div_division_name" wire:ignore.self>
                                            <label>Division:</label>
                                            <input type="text" class="form-control" id="division_name" wire:model.defer="division_name" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group" id="div_position_name" wire:ignore.self>
                                            <label>Position:</label>
                                            <input type="text" class="form-control" id="position_name" wire:model.defer="position_name" disabled>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group" id="div_local" wire:ignore.self>
                                            <label>Local:</label>
                                            <input type="text" class="form-control" id="local" wire:model.defer="local" disabled>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group" id="div_email" wire:ignore.self>
                                            <label>Email Address:</label>
                                            <input type="text" class="form-control" id="email" wire:model.defer="email" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div style="display: flex; align-items: center;">
                                            <i class="fab fa-readme mr-2"></i>
                                            <h6 class="mr-2">Request Details</h6>
                                            <hr style="flex-grow: 1; border: none; border-top: 1px solid #e9ecef;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group" id="div_request_type_id" wire:ignore.self>
                                                    <label>Request Type:</label>
                                                    <select class="form-control custom-select" name="request_type_id" id="request_type_id" wire:model="request_type_id" disabled>
                                                    <option value="">Please Select</option>
                                                    @foreach( $request_types as $request_type )
                                                    <option value="{{ $request_type->id }}">{{ $request_type->request_type_name }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                @error('request_type_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group" id="div_sub_request_type_id" wire:ignore.self>
                                                    <label>Sub Request Type:</label>
                                                    <select class="form-control custom-select" name="sub_request_type_id" id="sub_request_type_id" wire:model.defer="sub_request_type_id" disabled>
                                                    <option value="">Please Select</option>
                                                    @foreach( $form_sub_request_types as $form_sub_request_type )
                                                    <option value="{{ $form_sub_request_type->id }}">{{ $form_sub_request_type->sub_request_type_name }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                @error('sub_request_type_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group" id="div_request_details" wire:ignore.self>
                                                    <label>Request Description:</label>
                                                    <textarea class="form-control" id="request_details" rows="5" wire:model.defer="request_details" disabled></textarea>
                                                </div>
                                                @error('request_details')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>    
                                    </div>
                                </div>   
                                <div class="row">
                                    <div class="col-12">
                                        <div style="display: flex; align-items: center;">
                                            <i class="fas fa-tools mr-2"></i>
                                            <h6 class="mr-2">Action Details</h6>
                                            <hr style="flex-grow: 1; border: none; border-top: 1px solid #e9ecef;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group" id="div_technical_support_representative_name" wire:ignore.self>
                                            <label>Technical Support Representative:</label>
                                            <select class="form-control custom-select" name="technical_support_representative_name" id="technical_support_representative_name" wire:model.defer="sub_request_type_id" disabled>
                                                @foreach( $technical_support_representatives as $technical_support_representative )
                                                <option value="{{ $technical_support_representative->id }}">{{ $technical_support_representative->last_name.', '.$technical_support_representative->first_name.' '.$technical_support_representative->middle_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('request_type_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-6"> 
                                        <div class="form-group" id="div_resolved_datetime" wire:ignore.self>
                                            <label>Date Time Resolved:</label>
                                            <input id="resolved_datetime" type="text" class="form-control" value="{{ $now }}" disabled>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group" id="div_technical_support_representative_findings" wire:ignore.self>
                                            <label>Findings:</label><span class="text-danger" style="font-weight:bold;"> *</span>
                                            <textarea class="form-control" id="technical_support_representative_findings" rows="3" wire:model.defer="technical_support_representative_findings"></textarea>
                                        </div>
                                        @error('technical_support_representative_findings')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group" id="div_action_taken" wire:ignore.self>
                                            <label>Actions Taken:</label><span class="text-danger" style="font-weight:bold;"> *</span>
                                            <textarea class="form-control" id="action_taken" rows="3" wire:model.defer="action_taken"></textarea>
                                        </div>
                                        @error('action_taken')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <span><i class="fa fa-ban mr-2"></i>Cancel</span>
                        </button>
                        <button type="submit" class="btn btn-success">
                            <span><i class="fas fa-check-circle mr-2"></i>Tag as Resolved</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="close-request-form" wire:ignore.self>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form autocomplete="off" wire:submit.prevent="CloseRequest">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <span><i class="fas fa-robot mr-2"></i>ICT Service Request</span><span class="badge badge-success ml-2">Resolved</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group" id="div_created_at" wire:ignore.self>
                                            <label>Date Time Requested:</label>
                                            <input id="created_at" type="text" class="form-control" wire:model.defer="created_at" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group" id="div_ticket_no" wire:ignore.self>
                                            <label>Ticket no. :</label>
                                            <input id="ticket_no" type="text" class="form-control" wire:model.defer="ticket_no" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div style="display: flex; align-items: center; ">
                                            <i class="fas fa-user mr-2"></i>
                                            <h6 class="mr-2">Requestor Details</h6>
                                            <hr style="flex-grow: 1; border: none; border-top: 1px solid #e9ecef;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group" id="div_last_name" wire:ignore.self>
                                            <label>Last name:</label>
                                            <input type="text" class="form-control" id="last_name" wire:model.defer="last_name" disabled>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group" id="div_first_name" wire:ignore.self>
                                            <label>First name:</label>
                                            <input type="text" class="form-control" id="first_name" wire:model.defer="first_name" disabled>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group" id="div_middle_name" wire:ignore.self>
                                            <label>Middle name:</label>
                                            <input type="text" class="form-control" id="middle_name" wire:model.defer="middle_name" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-7">
                                        <div class="form-group" id="div_office_name" wire:ignore.self>
                                            <label>Office:</label>
                                            <input type="text" class="form-control" id="office_name" wire:model.defer="office_name" disabled>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group" id="div_division_name" wire:ignore.self>
                                            <label>Division:</label>
                                            <input type="text" class="form-control" id="division_name" wire:model.defer="division_name" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group" id="div_position_name" wire:ignore.self>
                                            <label>Position:</label>
                                            <input type="text" class="form-control" id="position_name" wire:model.defer="position_name" disabled>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group" id="div_local" wire:ignore.self>
                                            <label>Local:</label>
                                            <input type="text" class="form-control" id="local" wire:model.defer="local" disabled>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group" id="div_email" wire:ignore.self>
                                            <label>Email Address:</label>
                                            <input type="text" class="form-control" id="email" wire:model.defer="email" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div style="display: flex; align-items: center;">
                                            <i class="fab fa-readme mr-2"></i>
                                            <h6 class="mr-2">Request Details</h6>
                                            <hr style="flex-grow: 1; border: none; border-top: 1px solid #e9ecef;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group" id="div_request_type_id" wire:ignore.self>
                                                    <label>Request Type:</label>
                                                    <select class="form-control custom-select" name="request_type_id" id="request_type_id" wire:model="request_type_id" disabled>
                                                    <option value="">Please Select</option>
                                                    @foreach( $request_types as $request_type )
                                                    <option value="{{ $request_type->id }}">{{ $request_type->request_type_name }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                @error('request_type_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group" id="div_sub_request_type_id" wire:ignore.self>
                                                    <label>Sub Request Type:</label>
                                                    <select class="form-control custom-select" name="sub_request_type_id" id="sub_request_type_id" wire:model.defer="sub_request_type_id" disabled>
                                                    <option value="">Please Select</option>
                                                    @foreach( $form_sub_request_types as $form_sub_request_type )
                                                    <option value="{{ $form_sub_request_type->id }}">{{ $form_sub_request_type->sub_request_type_name }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                @error('sub_request_type_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group" id="div_request_details" wire:ignore.self>
                                                    <label>Request Description:</label>
                                                    <textarea class="form-control" id="request_details" rows="5" wire:model.defer="request_details" disabled></textarea>
                                                </div>
                                                @error('request_details')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>    
                                    </div>
                                </div>   
                                <div class="row">
                                    <div class="col-12">
                                        <div style="display: flex; align-items: center;">
                                            <i class="fas fa-tools mr-2"></i>
                                            <h6 class="mr-2">Action Details</h6>
                                            <hr style="flex-grow: 1; border: none; border-top: 1px solid #e9ecef;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group" id="div_technical_support_representative_name" wire:ignore.self>
                                            <label>Technical Support Representative:</label>
                                            <select class="form-control custom-select" name="technical_support_representative_name" id="technical_support_representative_name" wire:model.defer="sub_request_type_id" disabled>
                                                @foreach( $technical_support_representatives as $technical_support_representative )
                                                <option value="{{ $technical_support_representative->id }}">{{ $technical_support_representative->last_name.', '.$technical_support_representative->first_name.' '.$technical_support_representative->middle_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('request_type_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-6"> 
                                        <div class="form-group" id="div_resolved_datetime" wire:ignore.self>
                                            <label>Date Time Resolved:</label>
                                            <input id="resolved_datetime" name="resolved_datetime" type="text" class="form-control" wire:model.defer="resolved_datetime" disabled>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group" id="div_technical_support_representative_findings" wire:ignore.self>
                                            <label>Findings:</label>
                                            <textarea class="form-control" id="technical_support_representative_findings" rows="3" wire:model.defer="technical_support_representative_findings" disabled></textarea>
                                        </div>
                                        @error('technical_support_representative_findings')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group" id="div_action_taken" wire:ignore.self>
                                            <label>Actions Taken:</label>
                                            <textarea class="form-control" id="action_taken" rows="3" wire:model.defer="action_taken" disabled></textarea>
                                        </div>
                                        @error('action_taken')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <span><i class="fa fa-ban mr-2"></i>Cancel</span>
                        </button>
                        <button type="submit" class="btn btn-secondary">
                            <span><i class="fas fa-check-double mr-2"></i>Tag as Completed</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="cancel-ict-request-form" tabindex="-1" aria-labelledby="confirmCancelIctRequestModalLabel" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <form autocomplete="off" wire:submit.prevent="CancelIctRequest">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmCancelIctRequestModalLabel">Are you sure you want to cancel your Request?</h5>
                    </div>
                    <div class="modal-body">
                        <p>Kindly state the reason for cancellation:</p>
                        <textarea class="form-control" id="reason_for_cancellation" rows="3" wire:model.defer="reason_for_cancellation"></textarea>
                        @error('reason_for_cancellation')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <span><i class="fa fa-ban mr-2"></i>Cancel</span>
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <span><i class="fas fa-stop mr-2"></i>Submit</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete-form" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <form autocomplete="off" wire:submit.prevent="Delete">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Are you sure you want to delete this record?</h5>
                    </div>
                    <div class="modal-body">
                        <p>Please enter your password to confirm deletion:</p>
                        <input type="password" wire:model="password" class="form-control" placeholder="Enter your password">
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <span><i class="fa fa-ban mr-2"></i>Cancel</span>
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <span><i class="fas fa-trash-alt mr-2"></i>Delete</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
