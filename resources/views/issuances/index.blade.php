@extends('layouts.b_app')

@push('page_css')
<style>
    .skeleton-loader .skeleton-line {
        width: 100%;
        height: 1.5rem;
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
        margin-bottom: 0.5rem;
        border-radius: 4px;
    }

    @keyframes shimmer {
        0% {
            background-position: 200% 0;
        }
        100% {
            background-position: -200% 0;
        }
    }

    .shimmer-button {
        position: relative;
        overflow: hidden;
    }

    .shimmer-button::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 200%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: 0.5s;
    }

    .shimmer-button:hover::after {
        left: 100%;
    }
</style>
@endpush

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Issuances</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Issuances</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-filter mr-2"></i>
                            Filter Options
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="issuanceCategory">Issuance Category</label>
                                <select class="form-control" id="issuanceCategory">
                                    <option>ALL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="searchByTitle">Search (by Title)</label>
                                <input type="text" class="form-control" id="searchByTitle" placeholder="Enter title...">
                            </div>
                            <div class="form-group">
                                <label for="issuanceNo">Issuance No.</label>
                                <input type="text" class="form-control" id="issuanceNo" placeholder="Enter issuance no...">
                            </div>
                            <div class="form-group">
                                <label>Date Range</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="dateRange" placeholder="dd/mm/yyyy">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger shimmer-button btn-block">
                                <i class="fas fa-times mr-2"></i>
                                Clear
                            </button>
                            <button type="button" class="btn btn-primary shimmer-button btn-block">
                                <i class="fas fa-search mr-2"></i>
                                Search
                            </button>
                        </form>
                    </div>
                </div>
                <button class="btn btn-primary shimmer-button btn-block mb-3">
                    <i class="fas fa-upload mr-2"></i>
                    Upload Document
                </button>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List of Issuances</h3>
                    </div>
                    <div class="card-body">
                        <table id="issuancesTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Issuance Number</th>
                                    <th>Document Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="skeleton-loader">
                                    <td colspan="4">
                                        <div class="skeleton-line"></div>
                                        <div class="skeleton-line"></div>
                                        <div class="skeleton-line"></div>
                                        <div class="skeleton-line"></div>
                                        <div class="skeleton-line"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Upload form will go here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Edit form will go here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this document?</p>
                <div class="form-group">
                    <label for="deleteReason">Reason for deletion:</label>
                    <textarea class="form-control" id="deleteReason" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Recipient Modal -->
<div class="modal fade" id="recipientModal" tabindex="-1" role="dialog" aria-labelledby="recipientModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="recipientModalLabel">Select Recipients</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Recipient selection will go here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page_scripts')
<script>
    $(document).ready(function() {
        var table = $('#issuancesTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "/api/issuances",
            "columns": [
                { "data": "subject" },
                { "data": "issuance_number" },
                { "data": "document_date" },
                { "data": "actions", "orderable": false, "searchable": false }
            ],
            "drawCallback": function( settings ) {
                $('.skeleton-loader').hide();
                $('#issuancesTable tbody').show();
            }
        });

        $('#search_button').on('click', function() {
            table.draw();
        });

        $('#clear_button').on('click', function() {
            $('#issuanceCategory').val('ALL');
            $('#searchByTitle').val('');
            $('#issuanceNo').val('');
            $('#dateRange').val('');
            table.draw();
        });

        // Show Upload Modal
        $('.shimmer-button').on('click', function() {
            $('#uploadModal').modal('show');
        });
    });
</script>
@endpush
