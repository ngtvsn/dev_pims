<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Document Tracking</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('module-selector') }}">Modules</a></li>
                        <li class="breadcrumb-item active">Document Tracking</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <!-- Summary Cards -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>12</h3>
                            <p>Incoming</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-inbox"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>31</h3>
                            <p>Outgoing</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>420</h3>
                            <p>Completed</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>7</h3>
                            <p>Cancelled</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title"><i class="fas fa-file-alt mr-2"></i>All Documents</h3>
                        <button class="btn btn-primary"><i class="fas fa-plus-circle mr-2"></i>Create New Slip</button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Search and Filters -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="search" class="form-control" placeholder="Search by Tracking # or Title...">
                                <div class="input-group-append">
                                    <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="#advancedFilters" data-toggle="collapse" class="btn btn-outline-secondary">
                                <i class="fas fa-filter mr-2"></i>Advanced Filters
                            </a>
                        </div>
                    </div>

                    <div class="collapse" id="advancedFilters">
                        <div class="card card-body bg-light mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Office of Origin</label>
                                        <select class="form-control">
                                            <option>All</option>
                                            <option>Management Services Division</option>
                                            <option>Finance Division</option>
                                            <option>HR Division</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Document Type</label>
                                        <select class="form-control">
                                            <option>All</option>
                                            <option>DTR</option>
                                            <option>Memorandum</option>
                                            <option>Purchase Order</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Transaction</label>
                                        <select class="form-control">
                                            <option>All</option>
                                            <option>HR</option>
                                            <option>Procurement</option>
                                            <option>Finance</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Document Table -->
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Tracking #</th>
                                    <th>Document Title</th>
                                    <th>Document Type</th>
                                    <th>Office of Origin</th>
                                    <th>Document Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table-active">
                                    <td>2025-SM-J14-21</td>
                                    <td>DTR June 2025 - Dr. Froilainne A. Dela Cruz</td>
                                    <td>DTR</td>
                                    <td>Management Services Division</td>
                                    <td>Jul 02, 2025</td>
                                    <td>
                                        <a href="#viewDetails" class="btn btn-sm btn-primary"><i class="fas fa-eye mr-1"></i>View Details</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2025-FN-A02-11</td>
                                    <td>Request for Q2 Budget Release</td>
                                    <td>Budget Request</td>
                                    <td>Finance Division</td>
                                    <td>Jul 01, 2025</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye mr-1"></i>View Details</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Document Details View -->
            <div id="viewDetails" class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-search-location mr-2"></i>Document Monitoring Slip</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4><strong>DOCUMENT MONITORING SLIP</strong></h4>
                            <p class="lead">Tracking #: 2025-SM-J14-21</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <img src="https://barcode.tec-it.com/barcode.ashx?data=2025-SM-J14-21&code=Code128&dpi=96" alt="barcode"/>
                        </div>
                    </div>
                    <hr>
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <strong>Office of Origin:</strong><br>
                            Management Services Division
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <strong>Document Date:</strong><br>
                            Jul 02, 2025
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <strong>Transaction:</strong><br>
                            HR
                        </div>
                    </div>
                     <div class="row invoice-info mt-3">
                        <div class="col-sm-4 invoice-col">
                            <strong>Document Type:</strong><br>
                            DTR
                        </div>
                        <div class="col-sm-8 invoice-col">
                            <strong>Document Title:</strong><br>
                            DTR June 2025 - Dr. Froilainne A. Dela Cruz
                        </div>
                    </div>
                    <div class="row invoice-info mt-3">
                        <div class="col-sm-12 invoice-col">
                            <strong>Attachments:</strong><br>
                            DTR, Certificate and PITAHC Order
                        </div>
                    </div>
                     <div class="row invoice-info mt-3">
                        <div class="col-sm-12 invoice-col">
                            <strong>Note:</strong><br>
                            (No notes)
                        </div>
                    </div>

                    <hr>
                    <h5 class="mt-4 mb-3">Routing History</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Date</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Action/Remarks</th>
                                    <th>Name/Signature</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Jul 02, 2025</td>
                                    <td>Management Services Division</td>
                                    <td>HR Division</td>
                                    <td>For review and processing.</td>
                                    <td>Juan Dela Cruz</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
