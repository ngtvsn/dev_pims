
<div>    
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">List of CSM Responses</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('module-selector') }}">Module</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('css-results', ['param' => 2024]) }}">Client Satisfaction Measurement</a></li>
                        <li class="breadcrumb-item active">List of CSM Responses</li>
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
                                                <input type="search" wire:model.debounce.500ms="search" class="form-control" placeholder="Search by Name or Transacting Office..." aria-label="search" aria-describedby="basic-addon1">
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
                                                    <label>Client Type</label>
                                                    <select class="form-control" wire:model="SelectedClientType">
                                                        <option value="">Please Select</option>
                                                        @foreach( $client_types as $client_type )
                                                        <option value="{{ $client_type->id }}">{{ $client_type->client_type_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <div class="form-group">
                                                    <label>Transacting Office</label>
                                                    <select class="form-control" wire:model="SelectedTransactingOffice">
                                                        <option value="">Please Select</option>
                                                        @foreach( $transacting_offices as $transacting_office )
                                                        <option value="{{ $transacting_office->id }}">{{ $transacting_office->transacting_office_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <div class="form-group">
                                                    <label>Availed Service</label>
                                                    <select class="form-control" wire:model="SelectedAvailedService">
                                                        <option value="">Please Select</option>
                                                        @foreach( $availed_services as $availed_service )
                                                        <option value="{{ $availed_service->id }}">{{ $availed_service->availed_service_name_short }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-folder mr-2"></i>CSS Responses</h3>
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
                                            You have selected all <strong>{{ $css_responses->total() }}</strong> items.
                                        </div>
                                        @else
                                        <div>
                                            You have selected <strong>{{ count($checked) }}</strong> items, Do you want to Select All
                                            <strong>{{ $css_responses->total() }}</strong>?
                                            <a href="#" class="ml-2" wire:click="selectAll">Select All</a>
                                        </div>
                                        @endif
                                    </div>
                                    @endif
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover table-sm">
                                            <tr>
                                                <th style="vertical-align: middle; text-align: center"><input type="checkbox" wire:model="selectPage"></th>
                                                <th style="vertical-align: middle; text-align: center">Actions</th>
                                                <th style="vertical-align: middle; text-align: center">ID</th>
                                                <th style="vertical-align: middle; text-align: center">Name</th>
                                                <th style="vertical-align: middle; text-align: center">Sex</th>
                                                <th style="vertical-align: middle; text-align: center">Contact Details</th>
                                                <th style="vertical-align: middle; text-align: center">Client Type</th>
                                                <th style="vertical-align: middle; text-align: center">Transacting Office</th>
                                                <th style="vertical-align: middle; text-align: center">Date Accomplished</th>
                                            </tr>
                                            @foreach($css_responses as $css_response)
                                            <tr class="@if ($this->isChecked($css_response->id)) table-primary @else  @endif">
                                                <td style="vertical-align: middle; text-align: center"><input type="checkbox" value="{{ $css_response->id }}" wire:model="checked"></td>
                                                <td style="vertical-align: middle; text-align: center">
                                                    <div style="white-space: nowrap">
                                                        <button class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="View" onclick="location.href='{{ route('view-css-response', [$css_response->id]) }}'">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                        @if( Auth::user()->userlevel_id == 1 )
                                                        <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete" wire:click.prevent="DeleteForm( {{ $css_response->id }} )">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        @endif
                                                    </div>  
                                                </td>
                                                <td style="vertical-align: middle; text-align: center">{{ $css_response->id }}</td>
                                                <td style="vertical-align: middle; text-align: center">{{ $css_response->client_name ? strtoupper($css_response->client_name) : '(ANONYMOUS)' }}</td>
                                                <td style="vertical-align: middle; text-align: center">{{ strtoupper($css_response->sex_type->sex_type_name) }}</td>
                                                <td style="vertical-align: middle; text-align: center">{{ $css_response->contact_details ? $css_response->contact_details : '(NOT PROVIDED)' }}</td>
                                                <td style="vertical-align: middle; text-align: center">{{ strtoupper($css_response->client_type->client_type_name) }}</td>
                                                <td style="vertical-align: middle; text-align: center">{{ strtoupper($css_response->transacting_office->transacting_office_name) }}</td>
                                                <td style="vertical-align: middle; text-align: center">{{ Carbon\Carbon::parse($css_response->date_accomplished)->format('F d, Y') }}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="d-flex justify-content-center">
                                            {{ $css_responses->links() }}
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