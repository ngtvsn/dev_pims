<div>    
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">List Users</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">List Users</li>
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
                                                    <label>[ INSERT TABLE NAME ]</label>
                                                    <select class="form-control" wire:model="SelectedClientType">
                                                        <option value="">Please Select</option>
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
                                <h3 class="card-title"><i class="fas fa-folder mr-2"></i>List Users</h3>
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
                                            You have selected all <strong>{{ $users->total() }}</strong> items.
                                        </div>
                                        @else
                                        <div>
                                            You have selected <strong>{{ count($checked) }}</strong> items, Do you want to Select All
                                            <strong>{{ $users->total() }}</strong>?
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
                                                <th style="vertical-align: middle; text-align: center">Email</th>
                                                <th style="vertical-align: middle; text-align: center">Division</th>
                                                <th style="vertical-align: middle; text-align: center">Status</th>
                                                <th style="vertical-align: middle; text-align: center">Last updated</th>
                                            </tr>
                                            @foreach($users as $user)
                                            <tr class="@if ($this->isChecked($user->id)) table-primary @else  @endif">
                                                <td style="vertical-align: middle; text-align: center"><input type="checkbox" value="{{ $user->id }}" wire:model="checked"></td>
                                                <td style="vertical-align: middle; text-align: center">
                                                    <div style="white-space: nowrap">
                                                        <button class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="View" onclick="location.href='{{ route('view-css-response', [$user->id]) }}'">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                        <button class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit" wire:click.prevent="editUser( {{ $user->id }} )">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete" wire:click.prevent="DeleteForm( {{ $user->id }} )">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>  
                                                </td>
                                                <td style="vertical-align: middle; text-align: center">{{ $user->id }}</td>
                                                <td style="vertical-align: middle; text-align: center">{{ $user->last_name.', '.$user->first_name }}</td>
                                                <td style="vertical-align: middle; text-align: center">{{ $user->email }}</td>
                                                <td style="vertical-align: middle; text-align: center">{{ optional($user->division)->division_name }}</td>
                                                <td style="vertical-align: middle; text-align: center">{{ optional($user->status_type)->status_type_name }}</td>
                                                <td style="vertical-align: middle; text-align: center">{{ Carbon\Carbon::parse($user->updated_at)->format('F d, Y') }}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="d-flex justify-content-center">
                                            {{ $users->links() }}
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
