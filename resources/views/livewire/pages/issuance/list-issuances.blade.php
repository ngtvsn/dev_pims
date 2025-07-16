<div>    
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Issuances</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('module-selector') }}">Modules</a></li>
                            <li class="breadcrumb-item active">Issuances</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Left Column - Filter and Upload Cards -->
                    <div class="col-lg-3 mb-4">
                        <!-- Filter Card -->
                        <div class="card mb-4" role="region" aria-labelledby="filterCardTitle">
                            <div class="card-header bg-primary text-white">
                                <h3 class="card-title mb-0" id="filterCardTitle"><i class="fas fa-filter mr-2"></i>Filter Issuance</h3>
                            </div>
                            <div class="card-body">
                                <form id="filterForm" aria-label="Document filter form">
                                    <!-- Module Type Dropdown -->
                                    <div class="form-group">
                                        <label for="moduleType" class="form-label">Module Type</label>
                                        <select class="form-control" id="moduleType">
                                            <option value="" selected>All</option>
                                            <option value="Memorandum">Memorandum</option>
                                            <option value="PITAHC Personnel Order">PITAHC Personnel Order</option>
                                            <option value="PITAHC Order">PITAHC Order</option>
                                        </select>
                                    </div>
                                    
                                    <!-- Search Text Area -->
                                    <div class="form-group">
                                        <label for="searchText" class="form-label">Search</label>
                                        <div class="input-group">
                                            <textarea class="form-control" id="searchText" rows="2" placeholder="Search document content, subject, or control number"></textarea>
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-light">
                                                    <i class="fas fa-search text-muted"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">Enter keywords to search</small>
                                    </div>
                                    
                                    <!-- Issuance Number -->
                                    <div class="form-group">
                                        <label for="issuanceNumber" class="form-label">Issuance Number</label>
                                        <input type="number" class="form-control" id="issuanceNumber" placeholder="Enter issuance number" min="1" step="1">
                                        <div id="issuanceNumberError" class="invalid-feedback">
                                            Please enter a valid integer number
                                        </div>
                                        <small class="form-text text-muted">Enter the document issuance number (integers only)</small>
                                    </div>
                                    
                                    <!-- Date Range -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="dateFrom" class="form-label">From Date</label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control" id="dateFrom">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text bg-light">
                                                            <i class="fas fa-calendar-alt text-muted"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="dateTo" class="form-label">To Date</label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control" id="dateTo">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text bg-light">
                                                            <i class="fas fa-calendar-alt text-muted"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div id="dateError" class="invalid-feedback" style="display: none;">
                                                From date must be before or equal to To date
                                            </div>
                                            <small class="form-text text-muted">Select a date range to filter documents</small>
                                        </div>
                                    </div>
                                    
                                    <!-- Action Buttons -->
                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="button" id="clearBtn" class="btn btn-secondary mr-2">
                                            <i class="fas fa-eraser mr-1"></i>Clear
                                        </button>
                                        <button type="button" id="searchBtn" class="btn btn-primary">
                                            <i class="fas fa-search mr-1"></i>Search
                                        </button>
                                    </div>
                                    <div class="mt-2 text-right">
                                        <small class="text-muted">Press Ctrl+Enter to search quickly</small>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Quick Actions Card - Only for Document Controller/User Level 1 -->
                        @if((auth()->user()->userlevel && auth()->user()->userlevel->id == 1) || (auth()->user()->role == 'document_controller'))
                        <div class="card" role="region" aria-labelledby="actionsCardTitle">
                            <div class="card-header bg-success text-white">
                                <h3 class="card-title mb-0" id="actionsCardTitle"><i class="fas fa-bolt mr-2"></i>Quick Actions</h3>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <button type="button" id="uploadBtn" class="btn btn-success btn-block" data-toggle="modal" data-target="#uploadModal">
                                        <i class="fas fa-cloud-upload-alt mr-2"></i>Upload Document
                                    </button>
                                    <small class="text-muted mt-2 d-block">Upload new documents to the system</small>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Right Column - Data Table Card -->
                    <div class="col-lg-9">
                        <div class="card" role="region" aria-labelledby="tableCardTitle">
                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0" id="tableCardTitle"><i class="fas fa-list mr-2"></i>Document Issuance List</h3>
                                <span class="badge badge-light text-dark" id="documentCount" aria-live="polite">0 documents</span>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="issuanceTable" class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Issuance Number</th>
                                                <th>Subject</th>
                                                <th>Document Type</th>
                                                <th>Document Date</th>
                                                <th width="120">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Table data will be populated by JavaScript -->
                                        </tbody>
                                    </table>
                                </div>
                                <div id="emptyState" class="text-center py-5 d-none">
                                    <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                                    <h5>No Documents Found</h5>
                                    <p class="text-muted">Try adjusting your filters or upload a new document</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- PDF Preview Card -->
                        <div class="card d-none" id="pdfPreviewCard" role="region" aria-labelledby="pdfPreviewCardTitle">
                            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0" id="pdfPreviewCardTitle"><i class="fas fa-file-pdf mr-2"></i>PDF Preview</h3>
                                <div>
                                    <button type="button" class="btn btn-light btn-sm mr-2" id="downloadPdfFromCard">
                                        <i class="fas fa-download mr-1"></i>Download
                                    </button>
                                    <button type="button" class="btn btn-outline-light btn-sm" id="closePdfPreview">
                                        <i class="fas fa-times mr-1"></i>Close
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div id="pdfPreviewCardContainer" style="height: 60vh; overflow: auto; background: #f8f9fa;">
                                    <div class="text-center p-5">
                                        <i class="fas fa-spinner fa-spin fa-3x text-info mb-3"></i>
                                        <p>Loading PDF preview...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Upload Document Modal -->
        <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="uploadModalLabel">
                            <i class="fas fa-cloud-upload-alt mr-2"></i>Upload Document
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Two Column Layout: Form + PDF Preview -->
                        <div class="row">
                            <!-- Left Column: Document Form -->
                            <div class="col-md-4">
                                <!-- File Upload Section -->
                                <div class="mb-4">
                                    <h6><i class="fas fa-file-upload mr-2"></i>File Upload</h6>
                                    <div class="form-group">
                                        <label for="pdfFileInput">Select PDF File *</label>
                                        
                                        <!-- Custom Styled File Input -->
                                        <div class="custom-file-input-wrapper mb-3">
                                            <div class="file-input-container">
                                                <input type="file" id="pdfFileInput" accept=".pdf" class="custom-file-input" required>
                                                <label for="pdfFileInput" class="custom-file-label">
                                                    <i class="fas fa-file-pdf mr-2"></i>
                                                    <span id="fileInputLabel">Choose PDF File</span>
                                                </label>
                                            </div>
                                            <div id="fileInfo" class="file-info mt-2" style="display: none;">
                                                <small class="text-success">
                                                    <i class="fas fa-check-circle mr-1"></i>
                                                    <span id="fileName"></span>
                                                    <span id="fileSize" class="text-muted ml-2"></span>
                                                </small>
                                            </div>
                                        </div>
                                        
                                        <div id="fileError" class="invalid-feedback"></div>
                                        <small class="form-text text-muted">Select a PDF file (max 10MB)</small>
                                    </div>
                                </div>
                                
                                <!-- Document Details Form -->
                                <div id="documentForm">
                                    <h6><i class="fas fa-edit mr-2"></i>Document Details</h6>
                                    <form id="uploadDocumentForm">
                                        <!-- Row 1: Issuance Number and Document Type -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="docIssuanceNumber">Issuance Number *</label>
                                                    <input type="number" class="form-control" id="docIssuanceNumber" min="1" placeholder="Enter issuance number" required>
                                                    <small class="form-text text-muted">Sequential number for this document</small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="docType">Document Type *</label>
                                                    <select class="form-control" id="docType" required>
                                                        <option value="">Select Document Type</option>
                                                        <option value="Memorandum">Memorandum</option>
                                                        <option value="PITAHC Personnel Order">PITAHC Personnel Order</option>
                                                        <option value="PITAHC Order">PITAHC Order</option>
                                                        <option value="Administrative Order">Administrative Order</option>
                                                        <option value="Special Order">Special Order</option>
                                                        <option value="Office Order">Office Order</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Subject -->
                                        <div class="form-group">
                                            <label for="docSubject">Subject *</label>
                                            <textarea class="form-control" id="docSubject" rows="3" placeholder="Enter document subject" required></textarea>
                                            <small class="form-text text-muted">Enter the complete subject or title of the document</small>
                                        </div>
                                        
                                        <!-- Document Date with Action Buttons -->
                                        <div class="form-group">
                                            <label for="docDatePosted">Document Date *</label>
                                            <div class="d-flex align-items-end">
                                                <div class="flex-grow-1 mr-2">
                                                    <input type="date" class="form-control" id="docDatePosted" required>
                                                    <small class="form-text text-muted">Date when document was issued</small>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <button type="button" id="viewPreviewBtn" class="btn btn-sm btn-outline-info mb-1" disabled onclick="togglePdfPreview()">
                                                        <i class="fas fa-eye mr-1"></i>Preview
                                                    </button>
                                                    <button type="button" id="startUploadBtn" class="btn btn-sm btn-success" disabled>
                                                        <i class="fas fa-upload mr-1"></i>Upload
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                                <!-- Upload Progress -->
                                <div id="uploadProgress" class="d-none mt-3">
                                    <div class="progress mb-2">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%"></div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <small class="text-muted" id="uploadStatus">Preparing upload...</small>
                                        <small class="text-muted" id="uploadPercent">0%</small>
                                    </div>
                                </div>
                                
                                <!-- Messages -->
                                <div id="uploadMessages" class="mt-3"></div>
                            </div>
                            
                            <!-- Right Column: PDF Preview -->
                            <div class="col-md-8">
                                <div id="pdfPreviewSection" class="pdf-preview-section">
                                    <div class="card h-100">
                                        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">
                                                <i class="fas fa-file-pdf mr-2"></i>PDF Preview
                                            </h6>
                                            <button type="button" class="btn btn-sm btn-outline-light" onclick="closePdfPreview()">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="card-body p-0">
                                            <div id="pdfPreviewContainer" class="pdf-preview-container">
                                                <div class="preview-placeholder text-center p-4">
                                                    <i class="fas fa-file-pdf fa-3x text-muted mb-3"></i>
                                                    <h6 class="text-muted">PDF Preview</h6>
                                                    <p class="text-muted small">Select a PDF file to preview it here</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i>Cancel
                        </button>
                        <button type="button" class="btn btn-success" id="startUploadBtn" disabled>
                            <i class="fas fa-upload mr-1"></i>Upload Document
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Custom CSS for File Input -->
        <style>
        .custom-file-input-wrapper {
            position: relative;
        }
        
        .file-input-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .custom-file-input {
            position: absolute;
            opacity: 0;
            width: 0.1px;
            height: 0.1px;
            overflow: hidden;
        }
        
        .custom-file-label {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            color: #495057;
            min-width: 200px;
            justify-content: center;
        }
        
        .custom-file-label:hover {
            background: #e9ecef;
            border-color: #28a745;
            color: #28a745;
        }
        
        .custom-file-input:focus + .custom-file-label {
            outline: 2px solid #007bff;
            outline-offset: 2px;
        }
        
        .file-selected .custom-file-label {
            background: #d4edda;
            border-color: #28a745;
            color: #155724;
        }
        
        .file-info {
            padding: 8px 12px;
            background: #f8f9fa;
            border-radius: 4px;
            border-left: 4px solid #28a745;
        }
        
        .pdf-preview-section {
            height: 100%;
        }
        
        .pdf-preview-container {
            height: 650px;
            overflow: auto;
            background: #ffffff;
            border-radius: 4px;
            position: relative;
        }
        
        .pdf-preview-container iframe {
            width: 100%;
            height: 100%;
            border: none;
            background: white;
        }
        
        .pdf-controls {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
            background: rgba(0,0,0,0.7);
            border-radius: 4px;
            padding: 5px;
        }
        
        .pdf-controls button {
            margin: 0 2px;
            padding: 4px 8px;
            font-size: 12px;
        }
        
        .pdf-preview-container .preview-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            flex-direction: column;
            color: #6c757d;
        }
        </style>

        <!-- Simple PDF Upload Script -->
        <script>
        // Initialize PDF upload functionality
        function initializePdfUpload() {
            console.log('PDF Upload: Initializing...');
            
            // Store selected file
            window.selectedPdfFile = null;
            
            // File input change handler - using vanilla JavaScript
            const fileInput = document.getElementById('pdfFileInput');
            if (fileInput) {
                fileInput.addEventListener('change', function(e) {
                    console.log('PDF Upload: File input changed');
                    const file = e.target.files[0];
                
                    if (file) {
                        console.log('PDF Upload: File selected -', file.name);
                        
                        // Validate PDF
                        if (!file.name.toLowerCase().endsWith('.pdf')) {
                            alert('Only PDF files are allowed');
                            this.value = ''; // Clear selection using vanilla JS
                            resetPdfSelection();
                            return;
                        }
                        
                        // Check size (10MB)
                        if (file.size > 10 * 1024 * 1024) {
                            alert('File size exceeds 10MB limit');
                            this.value = ''; // Clear selection using vanilla JS
                            resetPdfSelection();
                            return;
                        }
                        
                        // Store file and update UI
                        window.selectedPdfFile = file;
                        
                        // Update UI elements
                        const selectedFileName = document.getElementById('selectedFileName');
                        const fileName = document.getElementById('fileName');
                        const fileSize = document.getElementById('fileSize');
                        const fileInfo = document.getElementById('fileInfo');
                        const viewPreviewBtn = document.getElementById('viewPreviewBtn');
                        
                        if (selectedFileName) {
                            selectedFileName.textContent = file.name;
                            selectedFileName.className = 'text-success';
                        }
                        
                        if (fileName) fileName.textContent = file.name;
                        if (fileSize) fileSize.textContent = '(' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
                        if (fileInfo) fileInfo.style.display = 'block';
                        if (viewPreviewBtn) viewPreviewBtn.disabled = false;
                        
                        // Enable form fields
                        const formFields = ['docIssuanceNumber', 'docType', 'docSubject', 'docDatePosted'];
                        formFields.forEach(fieldId => {
                            const field = document.getElementById(fieldId);
                            if (field) field.disabled = false;
                        });
                        
                        checkPdfFormCompletion();
                        console.log('PDF Upload: File processed successfully');
                    } else {
                        resetPdfSelection();
                    }
                });
            } else {
                console.error('PDF Upload: File input not found');
            }
            
            // Form field handlers
            const formFields = ['docIssuanceNumber', 'docType', 'docSubject', 'docDatePosted'];
            formFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field) {
                    field.addEventListener('input', checkPdfFormCompletion);
                    field.addEventListener('change', checkPdfFormCompletion);
                }
            });
            
            console.log('PDF Upload: Ready');
        }
        
        // Initialize when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initializePdfUpload);
        } else {
            initializePdfUpload();
        }
        
        // Also initialize when modal is shown
        document.addEventListener('DOMContentLoaded', function() {
            const uploadModal = document.getElementById('uploadModal');
            if (uploadModal) {
                uploadModal.addEventListener('shown.bs.modal', function() {
                    resetPdfSelection();
                });
            }
        });
        
        // Reset file selection
        function resetPdfSelection() {
            console.log('PDF Upload: Resetting selection');
            window.selectedPdfFile = null;
            
            // Reset UI elements using vanilla JavaScript
            const selectedFileName = document.getElementById('selectedFileName');
            const fileInfo = document.getElementById('fileInfo');
            const viewPreviewBtn = document.getElementById('viewPreviewBtn');
            const startUploadBtn = document.getElementById('startUploadBtn');
            
            if (selectedFileName) {
                selectedFileName.textContent = 'No file selected';
                selectedFileName.className = 'text-muted';
            }
            
            if (fileInfo) fileInfo.style.display = 'none';
            if (viewPreviewBtn) viewPreviewBtn.disabled = true;
            if (startUploadBtn) startUploadBtn.disabled = true;
            
            // Disable form fields
            const formFields = ['docIssuanceNumber', 'docType', 'docSubject', 'docDatePosted'];
            formFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field) {
                    field.disabled = true;
                    field.value = '';
                }
            });
        }
        
        // Check form completion
        function checkPdfFormCompletion() {
            const issuanceNumberField = document.getElementById('docIssuanceNumber');
            const documentTypeField = document.getElementById('docType');
            const subjectField = document.getElementById('docSubject');
            const datePostedField = document.getElementById('docDatePosted');
            const startUploadBtn = document.getElementById('startUploadBtn');
            
            const issuanceNumber = issuanceNumberField ? issuanceNumberField.value.trim() : '';
            const documentType = documentTypeField ? documentTypeField.value : '';
            const subject = subjectField ? subjectField.value.trim() : '';
            const datePosted = datePostedField ? datePostedField.value : '';
            const fileSelected = window.selectedPdfFile !== null;
            
            const isComplete = issuanceNumber && documentType && subject && datePosted && fileSelected;
            
            if (startUploadBtn) {
                startUploadBtn.disabled = !isComplete;
            }
            
            console.log('PDF Upload: Form check -', {
                issuanceNumber: !!issuanceNumber,
                documentType: !!documentType,
                subject: !!subject,
                datePosted: !!datePosted,
                fileSelected: fileSelected,
                isComplete: isComplete
            });
            
            return isComplete;
        }
        
        // Toggle PDF Preview (In-Modal) - Enhanced with better zoom
        function togglePdfPreview() {
            if (!window.selectedPdfFile) {
                alert('Please select a PDF file first');
                return;
            }
            
            const previewSection = document.getElementById('pdfPreviewSection');
            const previewContainer = document.getElementById('pdfPreviewContainer');
            
            if (previewSection.style.display === 'none' || !previewSection.style.display) {
                // Show preview
                console.log('PDF Upload: Showing in-modal preview');
                previewSection.style.display = 'block';
                
                try {
                    const fileURL = URL.createObjectURL(window.selectedPdfFile);
                    
                    // Create enhanced PDF preview with zoom controls
                    previewContainer.innerHTML = `
                        <div class="pdf-viewer-wrapper" style="height: 100%; position: relative;">
                            <div class="pdf-toolbar" style="background: #f8f9fa; padding: 8px; border-bottom: 1px solid #dee2e6; display: flex; justify-content: between; align-items: center;">
                                <div class="pdf-zoom-controls">
                                    <button class="btn btn-sm btn-outline-secondary mr-1" onclick="zoomPdf('out')" title="Zoom Out">
                                        <i class="fas fa-search-minus"></i>
                                    </button>
                                    <span class="mx-2 small" id="zoomLevel">100%</span>
                                    <button class="btn btn-sm btn-outline-secondary mr-2" onclick="zoomPdf('in')" title="Zoom In">
                                        <i class="fas fa-search-plus"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-info mr-2" onclick="fitToWidth()" title="Fit to Width">
                                        <i class="fas fa-arrows-alt-h"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success" onclick="openPdfInNewTab()" title="Open in New Tab">
                                        <i class="fas fa-external-link-alt"></i>
                                    </button>
                                </div>
                                <small class="text-muted">
                                    <i class="fas fa-file-pdf mr-1"></i>${window.selectedPdfFile.name}
                                </small>
                            </div>
                            <div class="pdf-content" style="height: calc(100% - 50px); overflow: auto; background: #f0f0f0;">
                                <iframe id="pdfIframe" 
                                        src="${fileURL}#zoom=150&view=FitH&toolbar=1&navpanes=0" 
                                        style="width: 100%; height: 100%; border: none; background: white; min-height: 600px;"
                                        title="PDF Preview"
                                        frameborder="0">
                                </iframe>
                            </div>
                        </div>
                    `;
                    
                    // Store URL and current zoom for cleanup
                    window.currentPdfURL = fileURL;
                    window.currentZoom = 150;
                    
                } catch (error) {
                    console.error('PDF Upload: Preview error -', error);
                    previewContainer.innerHTML = `
                        <div class="text-center p-4">
                            <i class="fas fa-exclamation-triangle fa-2x text-warning mb-3"></i>
                            <p>Unable to preview PDF: ${error.message}</p>
                            <div class="mt-3">
                                <button class="btn btn-sm btn-primary mr-2" onclick="downloadPdfFile()">
                                    <i class="fas fa-download mr-1"></i>Download to View
                                </button>
                                <button class="btn btn-sm btn-info" onclick="openPdfInNewTab()">
                                    <i class="fas fa-external-link-alt mr-1"></i>Open in New Tab
                                </button>
                            </div>
                        </div>
                    `;
                }
            } else {
                // Hide preview
                closePdfPreview();
            }
        }
        
        // Zoom PDF functions
        function zoomPdf(direction) {
            if (!window.currentPdfURL || !window.currentZoom) return;
            
            const iframe = document.getElementById('pdfIframe');
            const zoomLevel = document.getElementById('zoomLevel');
            
            if (direction === 'in') {
                window.currentZoom = Math.min(window.currentZoom + 25, 300);
            } else {
                window.currentZoom = Math.max(window.currentZoom - 25, 50);
            }
            
            iframe.src = `${window.currentPdfURL}#zoom=${window.currentZoom}&view=FitH&toolbar=1&navpanes=0`;
            zoomLevel.textContent = window.currentZoom + '%';
        }
        
        // Fit to width
        function fitToWidth() {
            if (!window.currentPdfURL) return;
            
            const iframe = document.getElementById('pdfIframe');
            const zoomLevel = document.getElementById('zoomLevel');
            
            window.currentZoom = 'FitH';
            iframe.src = `${window.currentPdfURL}#view=FitH&toolbar=1&navpanes=0`;
            zoomLevel.textContent = 'Fit Width';
        }
        
        // Open PDF in new tab as fallback
        function openPdfInNewTab() {
            if (!window.selectedPdfFile) {
                alert('Please select a PDF file first');
                return;
            }
            
            try {
                const fileURL = URL.createObjectURL(window.selectedPdfFile);
                const newWindow = window.open(fileURL, '_blank', 'width=1000,height=800,scrollbars=yes,resizable=yes');
                
                if (!newWindow) {
                    alert('Popup blocked. Please allow popups to view PDF in new tab.');
                } else {
                    console.log('PDF Upload: Opened in new tab');
                    setTimeout(() => URL.revokeObjectURL(fileURL), 60000);
                }
            } catch (error) {
                console.error('PDF Upload: New tab error -', error);
                alert('Unable to open PDF: ' + error.message);
            }
        }
        
        // Close PDF Preview
        function closePdfPreview() {
            console.log('PDF Upload: Closing preview');
            const previewSection = document.getElementById('pdfPreviewSection');
            const previewContainer = document.getElementById('pdfPreviewContainer');
            
            previewSection.style.display = 'none';
            previewContainer.innerHTML = `
                <div class="text-center p-4">
                    <i class="fas fa-spinner fa-spin fa-2x text-info mb-3"></i>
                    <p>Loading PDF preview...</p>
                </div>
            `;
            
            // Clean up URL
            if (window.currentPdfURL) {
                URL.revokeObjectURL(window.currentPdfURL);
                window.currentPdfURL = null;
            }
        }
        
        // Download PDF File
        function downloadPdfFile() {
            if (!window.selectedPdfFile) {
                alert('No PDF file selected');
                return;
            }
            
            try {
                const fileURL = URL.createObjectURL(window.selectedPdfFile);
                const link = document.createElement('a');
                link.href = fileURL;
                link.download = window.selectedPdfFile.name;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                
                // Clean up
                setTimeout(() => URL.revokeObjectURL(fileURL), 1000);
                
                console.log('PDF Upload: File download initiated');
            } catch (error) {
                console.error('PDF Upload: Download error -', error);
                alert('Unable to download PDF: ' + error.message);
            }
        }
        </script>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteModalLabel">
                            <i class="fas fa-exclamation-triangle mr-2"></i>Confirm Delete
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                            <p>Are you sure you want to delete this document?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i>Cancel
                        </button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">
                            <i class="fas fa-trash mr-1"></i>Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- PDF Preview Modal -->
        <div class="modal fade" id="pdfPreviewModal" tabindex="-1" aria-labelledby="pdfPreviewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="pdfPreviewModalLabel">
                            <i class="fas fa-file-pdf mr-2"></i>PDF Preview
                        </h5>
                        <div class="ml-auto">
                            <button type="button" class="btn btn-light btn-sm mr-2" id="downloadPdfFromPreview">
                                <i class="fas fa-download mr-1"></i>Download
                            </button>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body p-0">
                        <div id="pdfPreviewContainer" style="height: 70vh; overflow: auto;">
                            <div class="text-center p-5">
                                <i class="fas fa-spinner fa-spin fa-3x text-info mb-3"></i>
                                <p>Loading PDF preview...</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i>Close
                        </button>
                        <button type="button" class="btn btn-info" id="downloadPdfFromFooter">
                            <i class="fas fa-download mr-1"></i>Download PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
/* Document Issuance Page Styles */

/* Card styling */
.card {
    border-radius: 4px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

/* Button styling */
.btn-primary {
    background-color: #3498db;
    border-color: #3498db;
}

.btn-primary:hover {
    background-color: #2980b9;
    border-color: #2980b9;
}

.btn-secondary {
    background-color: #ecf0f1;
    border-color: #bdc3c7;
    color: #2c3e50;
}

.btn-secondary:hover {
    background-color: #bdc3c7;
    border-color: #95a5a6;
    color: #2c3e50;
}

.btn-success {
    background-color: #2ecc71;
    border-color: #2ecc71;
}

.btn-success:hover {
    background-color: #27ae60;
    border-color: #27ae60;
}

.btn-danger {
    background-color: #e74c3c;
    border-color: #e74c3c;
}

.btn-danger:hover {
    background-color: #c0392b;
    border-color: #c0392b;
}

/* Action buttons in table */
.action-btn {
    padding: 0.25rem 0.5rem;
    margin-right: 0.25rem;
}

/* Form control focus */
.form-control:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
}

/* Upload area styling */
.upload-area {
    border: 2px dashed #bdc3c7;
    transition: all 0.3s ease;
    cursor: pointer;
}

.upload-area:hover {
    border-color: #3498db;
    background-color: rgba(52, 152, 219, 0.05) !important;
}

.bg-light-success {
    background-color: rgba(46, 204, 113, 0.1) !important;
}

/* Error message styling */
.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #e74c3c;
}

/* Accessibility - focus styles */
a:focus, button:focus, input:focus, select:focus, textarea:focus {
    outline: 2px solid #3498db;
    outline-offset: 2px;
}

/* Statistics styling */
.stat-item {
    padding: 10px;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.1);
    margin-bottom: 10px;
}

.stat-number {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 0.8rem;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Upload modal styling */
.upload-area-modal {
    border: 3px dashed #28a745;
    transition: all 0.3s ease;
    cursor: pointer;
    border-radius: 10px;
}

.upload-area-modal:hover {
    border-color: #20c997;
    background-color: rgba(40, 167, 69, 0.05) !important;
    transform: translateY(-2px);
}

.upload-area-modal.dragover {
    border-color: #20c997;
    background-color: rgba(40, 167, 69, 0.1) !important;
    transform: scale(1.02);
}

.upload-icon {
    transition: transform 0.3s ease;
}

.upload-area-modal:hover .upload-icon {
    transform: scale(1.1);
}

/* File list styling */
.file-item {
    display: flex;
    align-items: center;
    padding: 10px;
    border: 1px solid #dee2e6;
    border-radius: 5px;
    margin-bottom: 10px;
    background: #f8f9fa;
}

.file-icon {
    margin-right: 10px;
    color: #28a745;
}

.file-info {
    flex-grow: 1;
}

.file-name {
    font-weight: 500;
    margin-bottom: 2px;
}

.file-size {
    font-size: 0.8rem;
    color: #6c757d;
}

.file-remove {
    color: #dc3545;
    cursor: pointer;
    padding: 5px;
}

.file-remove:hover {
    color: #c82333;
}

/* Enhanced table styling */
.table th {
    background-color: #f8f9fa;
    border-top: none;
    font-weight: 600;
    color: #495057;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.5px;
}

.table-hover tbody tr:hover {
    background-color: rgba(52, 152, 219, 0.05);
}

/* Badge enhancements */
.badge {
    font-size: 0.75rem;
    padding: 0.35em 0.65em;
}

/* Modal enhancements */
.modal-header {
    border-bottom: none;
    padding-bottom: 0;
}

.modal-footer {
    border-top: none;
    padding-top: 0;
}

/* Button hover effects */
.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.btn-lg:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

/* Loading animations */
@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.5; }
    100% { opacity: 1; }
}

.loading {
    animation: pulse 1.5s infinite;
}

/* Responsive adjustments */
@media (max-width: 991.98px) {
    .col-lg-4, .col-lg-8 {
        padding-left: 10px;
        padding-right: 10px;
    }
    
    .card {
        margin-bottom: 15px;
    }
    
    .card-body {
        padding: 15px;
    }
    
    .upload-area-modal {
        padding: 30px 15px !important;
    }
    
    .upload-area-modal i {
        font-size: 3em !important;
    }
    
    .stat-number {
        font-size: 1.2rem;
    }
}

@media (max-width: 767.98px) {
    .card-body {
        padding: 12px;
    }
    
    .form-label {
        margin-bottom: 0.25rem;
    }
    
    .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    
    .stat-item {
        padding: 8px;
    }
    
    .stat-number {
        font-size: 1rem;
    }
    
    .upload-area-modal {
        padding: 20px 10px !important;
    }
    
    .upload-area-modal i {
        font-size: 2.5em !important;
    }
}
</style>
@endpush

@push('scripts')
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script>
// Global function to open upload modal (accessible from HTML)
function openUploadModal() {
    console.log('openUploadModal function called');
    
    // Check if modal exists
    if ($('#uploadModal').length === 0) {
        console.log('ERROR: Modal not found in DOM');
        alert('Modal not found! Please check the HTML structure.');
        return;
    }
    
    // Try to show the modal
    try {
        // Try Bootstrap 4 method (most likely what's being used)
        $('#uploadModal').modal('show');
        console.log('Bootstrap 4 modal show executed');
    } catch (error) {
        console.log('Bootstrap 4 modal error:', error);
        
        // Manual fallback
        $('#uploadModal').addClass('show').css('display', 'block');
        $('body').addClass('modal-open').append('<div class="modal-backdrop fade show"></div>');
        console.log('Manual modal show executed');
    }
    
    // Reset modal content if the function exists
    if (typeof resetUploadModal === 'function') {
        try {
            resetUploadModal();
        } catch (error) {
            console.log('Reset modal error:', error);
        }
    }
}

// Document Issuance Page JavaScript

// Sample data for demonstration
const sampleDocuments = [
    {
        id: 1,
        controlNumber: "PITAHC-2025-001",
        subject: "Annual Budget Review",
        documentType: "Memorandum",
        documentSubtype: "Administrative",
        issuanceNumber: 101,
        datePosted: "2025-06-15",
        content: "Annual budget review for fiscal year 2025-2026"
    },
    {
        id: 2,
        controlNumber: "PITAHC-2025-002",
        subject: "Staff Promotion Guidelines",
        documentType: "PITAHC Personnel Order",
        documentSubtype: "Human Resources",
        issuanceNumber: 102,
        datePosted: "2025-06-10",
        content: "Updated guidelines for staff promotion and evaluation"
    },
    {
        id: 3,
        controlNumber: "PITAHC-2025-003",
        subject: "New Equipment Procurement",
        documentType: "PITAHC Order",
        documentSubtype: "Procurement",
        issuanceNumber: 103,
        datePosted: "2025-06-05",
        content: "Approval for procurement of new laboratory equipment"
    },
    {
        id: 4,
        controlNumber: "PITAHC-2025-004",
        subject: "COVID-19 Safety Protocols",
        documentType: "Memorandum",
        documentSubtype: "Health & Safety",
        issuanceNumber: 104,
        datePosted: "2025-05-28",
        content: "Updated safety protocols for COVID-19 prevention"
    },
    {
        id: 5,
        controlNumber: "PITAHC-2025-005",
        subject: "Holiday Schedule",
        documentType: "PITAHC Personnel Order",
        documentSubtype: "Administrative",
        issuanceNumber: 105,
        datePosted: "2025-05-20",
        content: "Official holiday schedule for the remainder of 2025"
    }
];

// Store the current documents in memory
let currentDocuments = [...sampleDocuments];

// Initialize DataTable
let dataTable;

// Function to open upload modal (called by onclick)
function openUploadModal() {
    console.log('openUploadModal function called');
    
    // Check if modal exists
    if ($('#uploadModal').length === 0) {
        console.log('ERROR: Modal not found in DOM');
        alert('Modal not found! Please check the HTML structure.');
        return;
    }
    
    console.log('Modal found, attempting to show...');
    
    // Try to show the modal
    try {
        $('#uploadModal').modal('show');
        console.log('Modal show command executed');
    } catch (error) {
        console.log('Bootstrap modal error:', error);
        // Fallback: manually show modal
        $('#uploadModal').addClass('show').css('display', 'block');
        $('.modal-backdrop').remove(); // Remove any existing backdrop
        $('body').append('<div class="modal-backdrop fade show"></div>');
        $('body').addClass('modal-open');
        console.log('Manual modal show executed');
    }
    
    // Reset modal content
    try {
        resetUploadModal();
    } catch (error) {
        console.log('Reset modal error:', error);
    }
}

$(document).ready(function() {
    // Update document count badge
    updateDocumentCount(sampleDocuments.length);
    
    // Set up module type dropdown with enhanced styling
    const moduleTypeDropdown = $('#moduleType');
    moduleTypeDropdown.on('change', function() {
        // Visual feedback when selection changes
        if ($(this).val()) {
            $(this).addClass('border-primary');
        } else {
            $(this).removeClass('border-primary');
        }
    });
    
    // Set up search text area with enhanced functionality
    const searchTextInput = $('#searchText');
    let searchTimeout;
    
    searchTextInput.on('input', function() {
        // Visual feedback when text is entered
        if ($(this).val()) {
            $(this).addClass('border-primary');
        } else {
            $(this).removeClass('border-primary');
        }
        
        // Debounce search to avoid excessive filtering while typing
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            // Auto-filtering while typing (optional)
        }, 500);
    });
    
    // Add keyboard shortcut (Ctrl+Enter) to trigger search
    searchTextInput.on('keydown', function(e) {
        if (e.ctrlKey && e.key === 'Enter') {
            applyFilters();
        }
    });
    
    // Set up issuance number field with validation
    const issuanceNumberInput = $('#issuanceNumber');
    
    issuanceNumberInput.on('input', function() {
        const value = $(this).val();
        
        // Visual feedback when a number is entered
        if (value) {
            $(this).addClass('border-primary');
        } else {
            $(this).removeClass('border-primary');
        }
        
        // Validate that the input is a positive integer
        if (value && (!Number.isInteger(Number(value)) || Number(value) <= 0)) {
            $(this).addClass('is-invalid');
            $('#issuanceNumberError').show();
        } else {
            $(this).removeClass('is-invalid');
            $('#issuanceNumberError').hide();
        }
    });
    
    // Ensure only integers can be entered
    issuanceNumberInput.on('keypress', function(e) {
        // Allow only digits (0-9) and control keys
        if (e.which < 48 || e.which > 57) {
            e.preventDefault();
        }
    });
    
    // Set up date range fields with validation
    const dateFromInput = $('#dateFrom');
    const dateToInput = $('#dateTo');
    
    // Add visual feedback when dates are selected
    dateFromInput.on('change', function() {
        if ($(this).val()) {
            $(this).addClass('border-primary');
        } else {
            $(this).removeClass('border-primary');
        }
        validateDateRange();
    });
    
    dateToInput.on('change', function() {
        if ($(this).val()) {
            $(this).addClass('border-primary');
        } else {
            $(this).removeClass('border-primary');
        }
        validateDateRange();
    });
    
    // Enhanced date range validation function
    function validateDateRange() {
        const dateFrom = dateFromInput.val() ? new Date(dateFromInput.val()) : null;
        const dateTo = dateToInput.val() ? new Date(dateToInput.val()) : null;
        
        if (dateFrom && dateTo && dateFrom > dateTo) {
            dateFromInput.addClass('is-invalid');
            dateToInput.addClass('is-invalid');
            $('#dateError').show();
            return false;
        } else {
            dateFromInput.removeClass('is-invalid');
            dateToInput.removeClass('is-invalid');
            $('#dateError').hide();
            return true;
        }
    }
    
    // Initialize DataTable
    dataTable = $('#issuanceTable').DataTable({
        data: currentDocuments,
        columns: [
            { 
                data: 'issuanceNumber',
                render: function(data, type, row) {
                    if (type === 'display') {
                        return '<span class="font-weight-bold text-primary">' + data + '</span>';
                    }
                    return data;
                }
            },
            { 
                data: 'subject',
                render: function(data, type, row) {
                    if (type === 'display') {
                        return '<span class="font-weight-bold">' + data + '</span>' +
                               '<div class="small text-muted">' + row.controlNumber + '</div>';
                    }
                    return data;
                }
            },
            { 
                data: 'documentType',
                render: function(data) {
                    let badgeClass = 'badge-secondary';
                    if (data === 'Memorandum') badgeClass = 'badge-info';
                    if (data === 'PITAHC Personnel Order') badgeClass = 'badge-warning';
                    if (data === 'PITAHC Order') badgeClass = 'badge-primary';
                    
                    return '<span class="badge ' + badgeClass + '">' + data + '</span>';
                }
            },
            { 
                data: 'datePosted',
                render: function(data) {
                    const date = new Date(data);
                    return '<span>' + date.toLocaleDateString() + '</span>' +
                           '<div class="small text-muted">' + date.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}) + '</div>';
                }
            },
            { 
                data: null,
                orderable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    return '<div class="btn-group" role="group" aria-label="Document actions">' +
                           '<button class="btn btn-sm btn-outline-success action-btn view-pdf-btn" data-id="' + row.id + '" title="View PDF">' +
                           '<i class="fas fa-eye"></i>' +
                           '</button>' +
                           '<button class="btn btn-sm btn-outline-info action-btn download-pdf-btn" data-id="' + row.id + '" title="Download PDF">' +
                           '<i class="fas fa-download"></i>' +
                           '</button>' +
                           '<button class="btn btn-sm btn-outline-primary action-btn edit-btn" data-id="' + row.id + '" title="Edit">' +
                           '<i class="fas fa-edit"></i>' +
                           '</button>' +
                           '<button class="btn btn-sm btn-outline-danger action-btn delete-btn" data-id="' + row.id + '" title="Delete">' +
                           '<i class="fas fa-trash"></i>' +
                           '</button>' +
                           '</div>';
                }
            }
        ],
        responsive: true,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        pageLength: 10,
        language: {
            emptyTable: "No documents found matching your criteria",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ documents",
            search: "Quick Search:",
            paginate: {
                first: '<i class="fas fa-angle-double-left"></i>',
                last: '<i class="fas fa-angle-double-right"></i>',
                next: '<i class="fas fa-angle-right"></i>',
                previous: '<i class="fas fa-angle-left"></i>'
            }
        },
        drawCallback: function() {
            // Update document count after table is drawn
            updateDocumentCount(this.api().page.info().recordsDisplay);
        }
    });

    // Search button click handler
    $('#searchBtn').on('click', function() {
        applyFilters();
    });

    // Clear button click handler
    $('#clearBtn').on('click', function() {
        clearFilters();
    });

    // Upload button click handler - Open modal
    $('#uploadBtn').on('click', function(e) {
        e.preventDefault();
        console.log('Upload button clicked - jQuery is working!');
        
        // Check if modal exists
        if ($('#uploadModal').length === 0) {
            console.log('ERROR: Modal not found in DOM');
            alert('Modal not found! Please check the HTML structure.');
            return;
        }
        
        console.log('Modal found, attempting to show...');
        
        // Try to show the modal with multiple methods
        try {
            // Method 1: Bootstrap 4/5 compatible
            $('#uploadModal').modal('show');
            console.log('Modal show command executed');
        } catch (error) {
            console.log('Bootstrap modal error:', error);
            
            // Method 2: Manual modal show (fallback)
            try {
                $('#uploadModal').addClass('show').css('display', 'block');
                $('.modal-backdrop').remove(); // Remove any existing backdrop
                $('body').append('<div class="modal-backdrop fade show"></div>');
                $('body').addClass('modal-open');
                console.log('Manual modal show executed');
            } catch (error2) {
                console.log('Manual modal error:', error2);
                alert('Cannot show modal. Error: ' + error.message);
            }
        }
        
        // Try to call reset function
        try {
            resetUploadModal();
        } catch (error) {
            console.log('Reset modal error:', error);
        }
    });

    // Browse button click handler in modal
    $('#browseBtn').on('click', function() {
        $('#fileInput').click();
    });

    // Upload File button click handler - triggers file selection
    $('#uploadFileBtn').on('click', function(e) {
        e.preventDefault();
        console.log('Upload File button clicked');
        
        // Check if file input exists
        if ($('#fileInput').length === 0) {
            console.log('ERROR: File input not found');
            alert('File input not found!');
            return;
        }
        
        console.log('Triggering file input click');
        $('#fileInput')[0].click(); // Use native DOM click instead of jQuery
    });

    // File input change handler
    $('#fileInput').on('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Show selected file name
            $('#fileName').text(file.name);
            $('#selectedFileName').show();
            
            // Enable the View Preview button and Upload Document button
            $('#viewPreviewBtn').prop('disabled', false);
            $('#startUploadBtn').prop('disabled', false);
            
            // Store the selected file for later use
            window.selectedFile = file;
            
            console.log('File selected:', file.name);
        } else {
            // Hide file name and disable buttons if no file selected
            $('#selectedFileName').hide();
            $('#viewPreviewBtn').prop('disabled', true);
            $('#startUploadBtn').prop('disabled', true);
            window.selectedFile = null;
        }
    });

    // View Preview button click handler
    $('#viewPreviewBtn').on('click', function(e) {
        e.preventDefault();
        console.log('View Preview clicked');
        
        if (window.selectedFile) {
            showPdfPreviewCard(window.selectedFile);
        } else {
            alert('Please select a file first.');
        }
    });

    // Close PDF Preview button click handler
    $('#closePdfPreview').on('click', function() {
        $('#pdfPreviewCard').addClass('d-none');
    });



    // Start upload button click handler
    $('#startUploadBtn').on('click', function() {
        startUploadProcess();
    });

    // Drag and drop functionality for upload modal
    const uploadAreaModal = $('.upload-area-modal');
    
    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadAreaModal.on(eventName, function(e) {
            e.preventDefault();
            e.stopPropagation();
        });
    });
    
    // Highlight drop area when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        uploadAreaModal.on(eventName, function() {
            $(this).addClass('dragover');
        });
    });
    
    // Remove highlight when item is dragged out or dropped
    ['dragleave', 'drop'].forEach(eventName => {
        uploadAreaModal.on(eventName, function() {
            $(this).removeClass('dragover');
        });
    });
    
    // Handle dropped files
    uploadAreaModal.on('drop', function(e) {
        const droppedFiles = Array.from(e.originalEvent.dataTransfer.files);
        if (droppedFiles.length > 0) {
            displaySelectedFiles(droppedFiles);
            $('#startUploadBtn').prop('disabled', false);
        }
    });

    // Update statistics on page load
    updateStatistics();
    
    // Drag and drop functionality
    const uploadArea = $('.upload-area');
    
    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.on(eventName, function(e) {
            e.preventDefault();
            e.stopPropagation();
        });
    });
    
    // Highlight drop area when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.on(eventName, function() {
            $(this).addClass('border-success bg-light-success');
        });
    });
    
    // Remove highlight when item is dragged out or dropped
    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.on(eventName, function() {
            $(this).removeClass('border-success bg-light-success');
        });
    });
    
    // Handle dropped files
    uploadArea.on('drop', function(e) {
        const droppedFile = e.originalEvent.dataTransfer.files[0];
        if (droppedFile) {
            handleFileUpload(droppedFile);
        }
    });

    // Edit button click handler (using event delegation)
    $('#issuanceTable').on('click', '.edit-btn', function() {
        const documentId = $(this).data('id');
        handleEditDocument(documentId);
    });

    // Delete button click handler (using event delegation)
    $('#issuanceTable').on('click', '.delete-btn', function() {
        const documentId = $(this).data('id');
        showDeleteConfirmation(documentId);
    });

    // View PDF button click handler (using event delegation)
    $('#issuanceTable').on('click', '.view-pdf-btn', function() {
        const documentId = $(this).data('id');
        viewPdfDocument(documentId);
    });

    // Download PDF button click handler (using event delegation)
    $('#issuanceTable').on('click', '.download-pdf-btn', function() {
        const documentId = $(this).data('id');
        downloadPdfDocument(documentId);
    });

    // Confirm delete button click handler
    $('#confirmDelete').on('click', function() {
        const documentId = $(this).data('id');
        deleteDocument(documentId);
        $('#deleteModal').modal('hide');
    });
});

// Apply filters to the data table
function applyFilters() {
    // Show loading indicator
    const searchBtn = $('#searchBtn');
    const originalSearchBtnHtml = searchBtn.html();
    searchBtn.html('<i class="fas fa-spinner fa-spin mr-1"></i>Searching...').prop('disabled', true);
    
    // Get filter values
    const moduleType = $('#moduleType').val();
    const searchText = $('#searchText').val().toLowerCase();
    const issuanceNumber = $('#issuanceNumber').val();
    const dateFrom = $('#dateFrom').val() ? new Date($('#dateFrom').val()) : null;
    const dateTo = $('#dateTo').val() ? new Date($('#dateTo').val()) : null;

    // Validate date range if both dates are provided
    if (dateFrom && dateTo && dateFrom > dateTo) {
        $('#dateError').show();
        searchBtn.html(originalSearchBtnHtml).prop('disabled', false);
        return;
    } else {
        $('#dateError').hide();
    }
    
    // Validate issuance number if provided
    if (issuanceNumber && (!Number.isInteger(Number(issuanceNumber)) || Number(issuanceNumber) <= 0)) {
        $('#issuanceNumberError').show();
        searchBtn.html(originalSearchBtnHtml).prop('disabled', false);
        return;
    }

    // Simulate a slight delay for better UX
    setTimeout(() => {
        // Filter the documents
        const filteredDocuments = sampleDocuments.filter(doc => {
            // Filter by module type (now using documentType)
            if (moduleType && doc.documentType !== moduleType) {
                return false;
            }

            // Filter by search text
            if (searchText && !doc.subject.toLowerCase().includes(searchText) && 
                !doc.content.toLowerCase().includes(searchText) &&
                !doc.controlNumber.toLowerCase().includes(searchText)) {
                return false;
            }

            // Filter by issuance number
            if (issuanceNumber && doc.issuanceNumber != issuanceNumber) {
                return false;
            }

            // Filter by date range
            const docDate = new Date(doc.datePosted);
            if (dateFrom && docDate < dateFrom) {
                return false;
            }
            if (dateTo && docDate > dateTo) {
                return false;
            }

            return true;
        });

        // Update the data table
        updateDataTable(filteredDocuments);
        
        // Restore search button
        searchBtn.html(originalSearchBtnHtml).prop('disabled', false);
    }, 300);
}

// Clear all filters
function clearFilters() {
    // Show loading indicator
    const clearBtn = $('#clearBtn');
    const originalClearBtnHtml = clearBtn.html();
    clearBtn.html('<i class="fas fa-spinner fa-spin mr-1"></i>Clearing...').prop('disabled', true);
    
    // Reset all form fields
    $('#moduleType').val('').removeClass('border-primary');
    $('#searchText').val('').removeClass('border-primary');
    $('#issuanceNumber').val('').removeClass('border-primary is-invalid');
    $('#dateFrom').val('').removeClass('border-primary is-invalid');
    $('#dateTo').val('').removeClass('border-primary is-invalid');
    
    // Hide error messages
    $('#dateError').hide();
    $('#issuanceNumberError').hide();
    
    // Simulate a slight delay for better UX
    setTimeout(() => {
        // Reset to all documents
        updateDataTable(sampleDocuments);
        
        // Restore clear button
        clearBtn.html(originalClearBtnHtml).prop('disabled', false);
    }, 300);
}

// Update the data table with new data
function updateDataTable(documents) {
    currentDocuments = [...documents];
    dataTable.clear();
    dataTable.rows.add(documents);
    dataTable.draw();
    
    // Update document count
    updateDocumentCount(documents.length);
    
    // Show/hide empty state
    if (documents.length === 0) {
        $('#emptyState').removeClass('d-none');
        $('.table-responsive').addClass('d-none');
    } else {
        $('#emptyState').addClass('d-none');
        $('.table-responsive').removeClass('d-none');
    }
}

// Update document count badge
function updateDocumentCount(count) {
    $('#documentCount').text(count + (count === 1 ? ' document' : ' documents'));
}

// Handle file upload
function handleFileUpload(file) {
    // Check file type
    const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    const allowedExtensions = ['.pdf', '.doc', '.docx'];
    
    // Check file type and extension
    const fileExtension = file.name.substring(file.name.lastIndexOf('.')).toLowerCase();
    if (!allowedTypes.includes(file.type) && !allowedExtensions.includes(fileExtension)) {
        showUploadError('Invalid file type. Please select a supported document format (PDF, DOC, DOCX).');
        return;
    }
    
    // Show progress bar
    const progressBar = $('#uploadProgress');
    const progressBarInner = progressBar.find('.progress-bar');
    progressBar.removeClass('d-none');
    progressBarInner.css('width', '0%');
    
    // Disable upload button during upload
    $('#uploadBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Uploading...');
    
    // Simulate upload process with progress updates
    let progress = 0;
    const progressInterval = setInterval(() => {
        progress += 10;
        progressBarInner.css('width', progress + '%').attr('aria-valuenow', progress);
        
        if (progress >= 100) {
            clearInterval(progressInterval);
            
            // Simulate server processing time
            setTimeout(() => {
                showUploadSuccess('File uploaded successfully: ' + file.name);
                
                // Reset file input and progress bar
                $('#fileInput').val('');
                progressBar.addClass('d-none');
                
                // Re-enable upload button
                $('#uploadBtn').prop('disabled', false).html('<i class="fas fa-upload mr-2"></i>Upload');
                
                // Add the uploaded file to the data table (for demo purposes)
                addUploadedFileToTable(file);
            }, 500);
        }
    }, 200);
}

// Add uploaded file to the data table (for demo purposes)
function addUploadedFileToTable(file) {
    // Create a new document object
    const newDocument = {
        id: sampleDocuments.length + 1,
        subject: file.name.replace(/\.[^/.]+$/, ""), // Remove file extension
        classification: "Memorandum", // Default classification
        issuanceNumber: Math.floor(Math.random() * 100) + 200, // Random number between 200-299
        datePosted: new Date().toISOString().split('T')[0], // Today's date
        content: "Uploaded document"
    };
    
    // Add to sample documents
    sampleDocuments.push(newDocument);
    
    // Update the data table
    updateDataTable(sampleDocuments);
}

// Show upload error message
function showUploadError(message) {
    $('#uploadSuccess').addClass('d-none');
    $('#uploadError').text(message).removeClass('d-none');
    
    // Hide error after 5 seconds
    setTimeout(() => {
        $('#uploadError').addClass('d-none');
    }, 5000);
}

// Show upload success message
function showUploadSuccess(message) {
    $('#uploadError').addClass('d-none');
    $('#uploadSuccess').text(message).removeClass('d-none');
    
    // Hide success message after 5 seconds
    setTimeout(() => {
        $('#uploadSuccess').addClass('d-none');
    }, 5000);
}

// Handle edit document
function handleEditDocument(documentId) {
    // Find the document by ID
    const document = currentDocuments.find(doc => doc.id === documentId);
    
    if (document) {
        // Create edit modal if it doesn't exist
        if ($('#editModal').length === 0) {
            const modalHtml = `
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="editModalLabel">Edit Document</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editForm">
                                    <input type="hidden" id="editDocumentId">
                                    <div class="form-group">
                                        <label for="editSubject" class="form-label">Subject</label>
                                        <input type="text" class="form-control" id="editSubject" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="editClassification" class="form-label">Classification</label>
                                        <select class="form-control" id="editClassification" required>
                                            <option value="Memorandum">Memorandum</option>
                                            <option value="PITAHC Personnel Order">PITAHC Personnel Order</option>
                                            <option value="PITAHC Order">PITAHC Order</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="editIssuanceNumber" class="form-label">Issuance Number</label>
                                        <input type="number" class="form-control" id="editIssuanceNumber" required min="1">
                                    </div>
                                    <div class="form-group">
                                        <label for="editDatePosted" class="form-label">Date Posted</label>
                                        <input type="date" class="form-control" id="editDatePosted" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="editContent" class="form-label">Content</label>
                                        <textarea class="form-control" id="editContent" rows="3" required></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="saveEditBtn">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            $('body').append(modalHtml);
            
            // Add save button handler
            $('#saveEditBtn').on('click', function() {
                saveEditedDocument();
            });
        }
        
        // Populate form with document data
        $('#editDocumentId').val(document.id);
        $('#editSubject').val(document.subject);
        $('#editClassification').val(document.classification);
        $('#editIssuanceNumber').val(document.issuanceNumber);
        $('#editDatePosted').val(document.datePosted);
        $('#editContent').val(document.content);
        
        // Show the modal
        $('#editModal').modal('show');
    }
}

// Save edited document
function saveEditedDocument() {
    // Get form values
    const documentId = parseInt($('#editDocumentId').val());
    const subject = $('#editSubject').val();
    const classification = $('#editClassification').val();
    const issuanceNumber = parseInt($('#editIssuanceNumber').val());
    const datePosted = $('#editDatePosted').val();
    const content = $('#editContent').val();
    
    // Validate form
    if (!subject || !classification || !issuanceNumber || !datePosted || !content) {
        alert('Please fill in all required fields');
        return;
    }
    
    try {
        // Find document index
        const index = sampleDocuments.findIndex(doc => doc.id === documentId);
        
        if (index !== -1) {
            // Update document
            sampleDocuments[index] = {
                id: documentId,
                subject: subject,
                classification: classification,
                issuanceNumber: issuanceNumber,
                datePosted: datePosted,
                content: content
            };
            
            // Update data table
            updateDataTable(sampleDocuments);
            
            // Hide modal
            $('#editModal').modal('hide');
            
            // Show success message
            alert('Document updated successfully');
        }
    } catch (error) {
        console.error('Error updating document:', error);
        alert('Unable to update document. Please try again.');
    }
}

// Show delete confirmation modal
function showDeleteConfirmation(documentId) {
    // Find the document to show its details in the confirmation
    const document = currentDocuments.find(doc => doc.id === documentId);
    
    if (document) {
        // Update modal content with document details
        $('#deleteModal .modal-body').html(`
            <p>Are you sure you want to delete this document?</p>
            <div class="alert alert-warning">
                <strong>${document.subject}</strong><br>
                Classification: ${document.classification}<br>
                Issuance #: ${document.issuanceNumber}
            </div>
            <p class="text-danger"><small>This action cannot be undone.</small></p>
        `);
        
        // Set document ID to delete button
        $('#confirmDelete').data('id', documentId);
        
        // Show the modal
        $('#deleteModal').modal('show');
    }
}

// Delete document
function deleteDocument(documentId) {
    try {
        // Show loading indicator
        const deleteBtn = $('#confirmDelete');
        const originalDeleteBtnHtml = deleteBtn.html();
        deleteBtn.html('<i class="fas fa-spinner fa-spin mr-1"></i>Deleting...').prop('disabled', true);
        
        // Simulate server delay
        setTimeout(() => {
            // Remove document from the sample data
            const index = sampleDocuments.findIndex(doc => doc.id === documentId);
            if (index !== -1) {
                sampleDocuments.splice(index, 1);
                
                // Update the data table
                updateDataTable(sampleDocuments);
                
                // Hide modal
                $('#deleteModal').modal('hide');
                
                // Show success message
                alert('Document deleted successfully');
            }
            
            // Restore delete button
            deleteBtn.html(originalDeleteBtnHtml).prop('disabled', false);
        }, 500);
    } catch (error) {
        console.error('Error deleting document:', error);
        alert('Unable to delete document. Please try again.');
        
        // Restore delete button
        $('#confirmDelete').html('Delete').prop('disabled', false);
    }
}

// Reset upload modal to initial state
function resetUploadModal() {
    $('#fileList').addClass('d-none');
    $('#uploadProgress').addClass('d-none');
    $('#documentForm').addClass('d-none');
    $('#uploadMessages').empty();
    $('#selectedFiles').empty();
    $('#fileInput').val('');
    $('#startUploadBtn').prop('disabled', true);
    $('#uploadDocumentForm')[0].reset();
}

// Display selected files in the modal
function displaySelectedFiles(files) {
    const selectedFilesContainer = $('#selectedFiles');
    selectedFilesContainer.empty();
    
    files.forEach((file, index) => {
        const fileSize = (file.size / 1024 / 1024).toFixed(2) + ' MB';
        const fileIcon = getFileIcon(file.name);
        
        const fileItem = `
            <div class="file-item" data-index="${index}">
                <div class="file-icon">
                    <i class="${fileIcon} fa-2x"></i>
                </div>
                <div class="file-info">
                    <div class="file-name">${file.name}</div>
                    <div class="file-size">${fileSize}</div>
                </div>
                <div class="file-remove" onclick="removeFile(${index})">
                    <i class="fas fa-times"></i>
                </div>
            </div>
        `;
        selectedFilesContainer.append(fileItem);
    });
    
    $('#fileList').removeClass('d-none');
    $('#documentForm').removeClass('d-none');
    
    // Set default date to today
    $('#docDatePosted').val(new Date().toISOString().split('T')[0]);
}

// Get appropriate file icon based on file extension
function getFileIcon(filename) {
    const extension = filename.split('.').pop().toLowerCase();
    switch (extension) {
        case 'pdf':
            return 'fas fa-file-pdf text-danger';
        case 'doc':
        case 'docx':
            return 'fas fa-file-word text-primary';
        default:
            return 'fas fa-file text-secondary';
    }
}

// Remove file from selection
function removeFile(index) {
    const fileInput = document.getElementById('fileInput');
    const dt = new DataTransfer();
    const files = Array.from(fileInput.files);
    
    files.forEach((file, i) => {
        if (i !== index) {
            dt.items.add(file);
        }
    });
    
    fileInput.files = dt.files;
    
    if (dt.files.length > 0) {
        displaySelectedFiles(Array.from(dt.files));
    } else {
        $('#fileList').addClass('d-none');
        $('#documentForm').addClass('d-none');
        $('#startUploadBtn').prop('disabled', true);
    }
}

// Start the upload process
function startUploadProcess() {
    console.log('Starting upload process');
    
    // Check if file is selected
    if (!window.selectedPdfFile) {
        showUploadMessage('Please select a PDF file first.', 'danger');
        return;
    }
    
    // Get form values
    const subject = $('#docSubject').val().trim();
    const documentType = $('#docType').val();
    const issuanceNumber = $('#docIssuanceNumber').val().trim();
    const datePosted = $('#docDatePosted').val();
    
    // Validate form completion
    if (!checkFormCompletion()) {
        showUploadMessage('Please fill in all required fields.', 'danger');
        return;
    }
    
    console.log('Form validation passed, starting upload');
    
    // Show progress
    $('#uploadProgress').removeClass('d-none');
    $('#startUploadBtn').prop('disabled', true);
    
    // Simulate upload process with the selected PDF file
    simulatePdfUpload(window.selectedPdfFile, {
        subject: subject,
        documentType: documentType,
        issuanceNumber: parseInt(issuanceNumber),
        datePosted: datePosted
    });
}

// Simulate PDF file upload with progress and error handling
function simulatePdfUpload(file, documentData) {
    console.log('Starting PDF upload simulation for:', file.name);
    
    const progressBar = $('#uploadProgress .progress-bar');
    const uploadStatus = $('#uploadStatus');
    const uploadPercent = $('#uploadPercent');
    
    // Simulate random upload failure (10% chance for testing)
    const shouldFail = Math.random() < 0.1;
    
    let progress = 0;
    const interval = setInterval(() => {
        progress += 10;
        progressBar.css('width', progress + '%').attr('aria-valuenow', progress);
        uploadPercent.text(progress + '%');
        
        // Update status messages based on progress
        if (progress <= 30) {
            uploadStatus.text('Uploading PDF file...');
        } else if (progress <= 60) {
            uploadStatus.text('Processing document...');
        } else if (progress <= 90) {
            uploadStatus.text('Saving to database...');
        } else {
            uploadStatus.text('Finalizing...');
        }
        
        // Simulate failure at 70% progress
        if (shouldFail && progress >= 70) {
            clearInterval(interval);
            handleUploadError('Network error occurred during upload. Please try again.');
            return;
        }
        
        if (progress >= 100) {
            clearInterval(interval);
            
            try {
                // Create new document object
                const newDocument = {
                    id: sampleDocuments.length + 1,
                    controlNumber: `PITAHC-${new Date().getFullYear()}-${String(sampleDocuments.length + 1).padStart(3, '0')}`,
                    subject: documentData.subject,
                    documentType: documentData.documentType,
                    documentSubtype: 'PDF Document',
                    issuanceNumber: documentData.issuanceNumber,
                    datePosted: documentData.datePosted,
                    content: `PDF Document: ${file.name}`
                };
                
                console.log('Adding new document to table:', newDocument);
                
                // Add to documents array
                sampleDocuments.push(newDocument);
                
                // Update the data table
                updateDataTable(sampleDocuments);
                
                // Update document count
                updateDocumentCount(sampleDocuments.length);
                
                // Show success message and close modal
                showUploadSuccess(file.name);
                
                // Reset the modal after a short delay
                setTimeout(() => {
                    resetUploadModal();
                    $('#uploadModal').modal('hide');
                }, 2000);
                
            } catch (error) {
                console.error('Error processing upload:', error);
                handleUploadError('An error occurred while processing the document. Please try again.');
            }
        }
    }, 200);
}

// Handle upload errors with retry functionality
function handleUploadError(errorMessage) {
    console.log('Handling upload error:', errorMessage);
    
    // Hide progress bar
    $('#uploadProgress').addClass('d-none');
    
    // Re-enable upload button for retry
    $('#startUploadBtn').prop('disabled', false).html('<i class="fas fa-upload mr-1"></i>Retry Upload');
    
    // Show error message with retry option
    const retryMessage = `${errorMessage} <button type="button" class="btn btn-sm btn-outline-primary ml-2" onclick="retryUpload()">Retry</button>`;
    showUploadMessage(retryMessage, 'danger');
}

// Retry upload function
function retryUpload() {
    console.log('Retrying upload');
    
    // Clear error messages
    $('#uploadMessages').empty();
    
    // Reset upload button text
    $('#startUploadBtn').html('<i class="fas fa-upload mr-1"></i>Upload Document');
    
    // Start upload process again
    if (window.selectedPdfFile && checkFormCompletion()) {
        startUploadProcess();
    } else {
        showUploadMessage('Please ensure a file is selected and all fields are completed.', 'warning');
    }
}

// Enhanced error handling for various scenarios
function handleFileError(error, context = 'file operation') {
    console.error(`Error in ${context}:`, error);
    
    let userMessage = 'An unexpected error occurred. Please try again.';
    
    // Provide specific error messages based on error type
    if (error.name === 'SecurityError') {
        userMessage = 'Security error: Unable to access the selected file. Please try selecting the file again.';
    } else if (error.name === 'NotReadableError') {
        userMessage = 'Unable to read the selected file. The file may be corrupted or in use by another application.';
    } else if (error.message && error.message.includes('network')) {
        userMessage = 'Network error occurred. Please check your connection and try again.';
    } else if (error.message && error.message.includes('server')) {
        userMessage = 'Server error occurred. Please try again later.';
    }
    
    showUploadMessage(userMessage, 'danger');
}

// Add global error handler for unhandled errors
window.addEventListener('error', function(event) {
    if (event.filename && event.filename.includes('upload')) {
        console.error('Global error in upload module:', event.error);
        handleFileError(event.error, 'upload module');
    }
});

// Make retry function globally accessible
window.retryUpload = retryUpload;

// Add debugging and testing utilities
window.pdfUploadDebug = {
    testFileValidation: function(testFile) {
        console.log('=== Testing File Validation ===');
        if (!testFile) {
            console.log('No test file provided. Please provide a File object.');
            return;
        }
        
        console.log('File details:', {
            name: testFile.name,
            size: testFile.size,
            type: testFile.type,
            lastModified: new Date(testFile.lastModified)
        });
        
        const isValid = validateFile(testFile);
        console.log('Validation result:', isValid);
        return isValid;
    },
    
    testFormCompletion: function() {
        console.log('=== Testing Form Completion ===');
        const result = checkFormCompletion();
        console.log('Form completion result:', result);
        return result;
    },
    
    simulateUpload: function() {
        console.log('=== Simulating Upload ===');
        if (!window.selectedPdfFile) {
            console.log('No file selected. Please select a PDF file first.');
            return;
        }
        
        if (!checkFormCompletion()) {
            console.log('Form is not complete. Please fill all required fields.');
            return;
        }
        
        console.log('Starting test upload...');
        startUploadProcess();
    },
    
    resetModal: function() {
        console.log('=== Resetting Modal ===');
        resetUploadModal();
        console.log('Modal reset complete');
    },
    
    getStatus: function() {
        console.log('=== PDF Upload Module Status ===');
        return {
            selectedFile: window.selectedPdfFile ? {
                name: window.selectedPdfFile.name,
                size: window.selectedPdfFile.size,
                type: window.selectedPdfFile.type
            } : null,
            formComplete: checkFormCompletion(),
            uploadButtonEnabled: !$('#startUploadBtn').prop('disabled'),
            modalVisible: $('#uploadModal').hasClass('show'),
            totalDocuments: sampleDocuments.length
        };
    }
};

console.log('PDF Upload Module loaded successfully!');
console.log('Available debug functions: window.pdfUploadDebug');
console.log('- testFileValidation(file)');
console.log('- testFormCompletion()');
console.log('- simulateUpload()');
console.log('- resetModal()');
console.log('- getStatus()');

// Add immediate test function for the Choose File button
window.testChooseFileButton = function() {
    console.log('=== Testing Choose File Button ===');
    
    // Check if button exists
    const button = document.getElementById('chooseFileBtn');
    if (!button) {
        console.error('❌ Choose File button not found');
        return false;
    }
    console.log('✅ Choose File button found');
    
    // Check if file input exists
    const fileInput = document.getElementById('pdfFileInput');
    if (!fileInput) {
        console.error('❌ PDF file input not found');
        return false;
    }
    console.log('✅ PDF file input found');
    
    // Check if modal is open
    const modal = document.getElementById('uploadModal');
    const isModalOpen = modal && (modal.classList.contains('show') || modal.style.display === 'block');
    console.log('Modal open:', isModalOpen);
    
    // Try to trigger the file input directly
    try {
        console.log('Attempting to trigger file input...');
        fileInput.click();
        console.log('✅ File input click triggered successfully');
        return true;
    } catch (error) {
        console.error('❌ Error triggering file input:', error);
        return false;
    }
};

// Add a simple click test
window.testButtonClick = function() {
    console.log('=== Testing Button Click Event ===');
    const button = document.getElementById('chooseFileBtn');
    if (button) {
        console.log('Simulating button click...');
        button.click();
    } else {
        console.error('Button not found');
    }
};

// Show upload success message
function showUploadSuccess(fileName) {
    console.log('Showing upload success for:', fileName);
    
    const message = `PDF file "${fileName}" uploaded successfully!`;
    showUploadMessage(message, 'success');
}

// Show upload messages
function showUploadMessage(message, type = 'info') {
    console.log('Showing upload message:', message, 'Type:', type);
    
    const messagesContainer = $('#uploadMessages');
    let alertClass = 'alert-info';
    let icon = 'fas fa-info-circle';
    
    switch (type) {
        case 'success':
            alertClass = 'alert-success';
            icon = 'fas fa-check-circle';
            break;
        case 'danger':
        case 'error':
            alertClass = 'alert-danger';
            icon = 'fas fa-exclamation-circle';
            break;
        case 'warning':
            alertClass = 'alert-warning';
            icon = 'fas fa-exclamation-triangle';
            break;
    }
    
    const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            <i class="${icon} mr-2"></i>${message}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `;
    
    messagesContainer.html(alertHtml);
}

// Reset upload modal to initial state
function resetUploadModal() {
    console.log('Resetting upload modal');
    
    // Clear file selection
    $('#pdfFileInput').val('');
    window.selectedPdfFile = null;
    
    // Reset file display
    resetFileSelection();
    
    // Clear form fields
    $('#docIssuanceNumber').val('');
    $('#docType').val('');
    $('#docSubject').val('');
    $('#docDatePosted').val('');
    
    // Hide progress bar
    $('#uploadProgress').addClass('d-none');
    $('#uploadProgress .progress-bar').css('width', '0%');
    
    // Clear messages
    $('#uploadMessages').empty();
    
    // Disable form and upload button
    disableDocumentForm();
    
    console.log('Upload modal reset complete');
}
            showUploadMessage('Document uploaded successfully!', 'success');
            
            // Close modal after delay
            setTimeout(() => {
                $('#uploadModal').modal('hide');
            }, 2000);
        }
    }, 200);
}

// Show upload message
function showUploadMessage(message, type) {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const iconClass = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle';
    
    const messageHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            <i class="fas ${iconClass} mr-2"></i>${message}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `;
    
    $('#uploadMessages').html(messageHtml);
}

// Show PDF preview in card (not modal)
function showPdfPreviewCard(file) {
    console.log('Showing PDF preview for file:', file.name);
    
    // Update card title with file info
    $('#pdfPreviewCardTitle').html(`<i class="fas fa-file-pdf mr-2"></i>PDF Preview - ${file.name}`);
    
    // Show loading state
    $('#pdfPreviewCardContainer').html(`
        <div class="text-center p-5">
            <i class="fas fa-spinner fa-spin fa-3x text-info mb-3"></i>
            <p>Loading PDF preview...</p>
            <small class="text-muted">File: ${file.name}</small>
        </div>
    `);
    
    // Show the PDF preview card
    $('#pdfPreviewCard').removeClass('d-none');
    
    // Store the file for download functionality
    window.previewFile = file;
    
    // Simulate PDF loading (in real app, you'd load actual PDF)
    setTimeout(() => {
        // For demo purposes, show a placeholder PDF viewer
        $('#pdfPreviewCardContainer').html(`
            <div class="p-4">
                <div class="text-center border rounded p-4 bg-white mb-3">
                    <i class="fas fa-file-pdf fa-5x text-danger mb-3"></i>
                    <h5>${file.name}</h5>
                    <p class="text-muted">File Size: ${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                    <p class="text-muted">File Type: ${file.type}</p>
                    <hr>
                    <p><strong>PDF Preview</strong></p>
                    <p class="text-muted">In a real application, the actual PDF content would be displayed here using a PDF viewer like PDF.js</p>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle mr-2"></i>
                        This is a demo preview. The actual PDF content would be rendered here.
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary mr-2" onclick="$('#uploadModal').modal('show');">
                            <i class="fas fa-arrow-left mr-1"></i>Back to Upload
                        </button>
                        <button class="btn btn-success" onclick="downloadFileFromPreview()">
                            <i class="fas fa-download mr-1"></i>Download File
                        </button>
                    </div>
                </div>
            </div>
        `);
    }, 1500);
}

// Download file from preview card
function downloadFileFromPreview() {
    if (window.previewFile) {
        // Create download link for the selected file
        const url = URL.createObjectURL(window.previewFile);
        const a = document.createElement('a');
        a.href = url;
        a.download = window.previewFile.name;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
        
        alert(`File downloaded: ${window.previewFile.name}`);
    }
}

// Handle download from PDF preview card
$(document).ready(function() {
    $('#downloadPdfFromCard').on('click', function() {
        downloadFileFromPreview();
    });
});

// View PDF document function
function viewPdfDocument(documentId) {
    console.log('Viewing PDF for document ID:', documentId);
    
    // Find the document
    const document = currentDocuments.find(doc => doc.id === documentId);
    
    if (!document) {
        alert('Document not found!');
        return;
    }
    
    // Update modal title with document info
    $('#pdfPreviewModalLabel').html(`<i class="fas fa-file-pdf mr-2"></i>PDF Preview - ${document.subject}`);
    
    // Show loading state
    $('#pdfPreviewContainer').html(`
        <div class="text-center p-5">
            <i class="fas fa-spinner fa-spin fa-3x text-info mb-3"></i>
            <p>Loading PDF preview...</p>
            <small class="text-muted">Document: ${document.subject}</small>
        </div>
    `);
    
    // Show the modal
    $('#pdfPreviewModal').modal('show');
    
    // Store document ID for download buttons
    $('#downloadPdfFromPreview, #downloadPdfFromFooter').data('document-id', documentId);
    
    // Simulate PDF loading (in real app, you'd load actual PDF)
    setTimeout(() => {
        // For demo purposes, show a placeholder PDF viewer
        $('#pdfPreviewContainer').html(`
            <div class="text-center p-4">
                <div class="border rounded p-4 bg-light mb-3">
                    <i class="fas fa-file-pdf fa-5x text-danger mb-3"></i>
                    <h5>${document.subject}</h5>
                    <p class="text-muted">Control Number: ${document.controlNumber}</p>
                    <p class="text-muted">Document Type: ${document.documentType}</p>
                    <p class="text-muted">Date: ${new Date(document.datePosted).toLocaleDateString()}</p>
                    <hr>
                    <p><strong>PDF Preview</strong></p>
                    <p class="text-muted">In a real application, the actual PDF content would be displayed here using a PDF viewer like PDF.js</p>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle mr-2"></i>
                        This is a demo preview. Click "Download" to get the actual PDF file.
                    </div>
                </div>
            </div>
        `);
    }, 1500);
}

// Download PDF document function
function downloadPdfDocument(documentId) {
    console.log('Downloading PDF for document ID:', documentId);
    
    // Find the document
    const document = currentDocuments.find(doc => doc.id === documentId);
    
    if (!document) {
        alert('Document not found!');
        return;
    }
    
    // Show loading state
    const downloadBtn = $(event.target).closest('button');
    const originalHtml = downloadBtn.html();
    downloadBtn.html('<i class="fas fa-spinner fa-spin mr-1"></i>Downloading...').prop('disabled', true);
    
    // Simulate download process
    setTimeout(() => {
        // In a real application, you would download the actual PDF file
        // For demo purposes, we'll create a sample PDF content
        const pdfContent = generateSamplePDF(document);
        
        // Create download link
        const blob = new Blob([pdfContent], { type: 'application/pdf' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `${document.controlNumber}_${document.subject.replace(/[^a-zA-Z0-9]/g, '_')}.pdf`;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);
        
        // Restore button
        downloadBtn.html(originalHtml).prop('disabled', false);
        
        // Show success message
        alert(`PDF downloaded: ${document.subject}`);
    }, 2000);
}

// Generate sample PDF content (for demo purposes)
function generateSamplePDF(document) {
    // This is a simple text representation
    // In a real app, you'd retrieve the actual PDF file from the server
    return `PDF Document - ${document.subject}
    
Control Number: ${document.controlNumber}
Subject: ${document.subject}
Document Type: ${document.documentType}
Document Subtype: ${document.documentSubtype}
Issuance Number: ${document.issuanceNumber}
Date Posted: ${new Date(document.datePosted).toLocaleDateString()}
Content: ${document.content}

This is a demo PDF file generated for: ${document.subject}
In a real application, this would be the actual PDF document content.
`;
}

// Handle download from PDF preview modal
$(document).ready(function() {
    $('#downloadPdfFromPreview, #downloadPdfFromFooter').on('click', function() {
        const documentId = $(this).data('document-id');
        if (documentId) {
            downloadPdfDocument(documentId);
        }
    });
});

</script>

<!-- Direct script for modal function -->
<script>
// Enhanced PDF file handling with preview functionality
$(document).ready(function() {
    console.log('Initializing PDF upload functionality...');
    
    // Store selected file globally
    window.selectedPdfFile = null;
    
    // Initialize form state - disable everything first
    resetFileSelection();
    
    // File input change handler for PDF selection - using multiple methods for reliability
    $('#pdfFileInput').on('change', function(e) {
        console.log('File input changed, processing...');
        const file = e.target.files[0];
        
        if (file) {
            console.log('File selected:', file.name, 'Size:', file.size, 'Type:', file.type);
            
            // Validate PDF file
            if (!file.name.toLowerCase().endsWith('.pdf')) {
                alert('Only PDF files are allowed');
                $(this).val(''); // Clear selection
                resetFileSelection();
                return;
            }
            
            // Check file size (10MB limit)
            if (file.size > 10 * 1024 * 1024) {
                alert('File size exceeds 10MB limit');
                $(this).val(''); // Clear selection
                resetFileSelection();
                return;
            }
            
            // Store the file globally
            window.selectedPdfFile = file;
            
            // Display selected file
            $('#selectedFileName').text(file.name).removeClass('text-muted').addClass('text-success');
            $('#fileName').text(file.name);
            $('#fileSize').text('(' + (file.size / 1024 / 1024).toFixed(2) + ' MB)');
            $('#fileInfo').show();
            
            // Enable View Preview button
            $('#viewPreviewBtn').prop('disabled', false);
            
            // Enable form fields
            $('#docIssuanceNumber, #docType, #docSubject, #docDatePosted').prop('disabled', false);
            
            // Check if form is complete to enable upload button
            checkFormCompletion();
            
            console.log('PDF file selected and stored successfully:', file.name);
        } else {
            // No file selected
            console.log('No file selected');
            resetFileSelection();
        }
    });
    
    // Form field change handlers to enable upload button
    $('#docIssuanceNumber, #docType, #docSubject, #docDatePosted').on('input change', function() {
        checkFormCompletion();
    });
    
    console.log('PDF upload handlers initialized successfully');
});

// Reset file selection state
function resetFileSelection() {
    console.log('Resetting file selection');
    window.selectedPdfFile = null;
    $('#selectedFileName').text('No file selected').removeClass('text-success').addClass('text-muted');
    $('#fileInfo').hide();
    $('#viewPreviewBtn').prop('disabled', true);
    $('#docIssuanceNumber, #docType, #docSubject, #docDatePosted').prop('disabled', true);
    $('#startUploadBtn').prop('disabled', true);
}

// Check if form is complete and enable/disable upload button
function checkFormCompletion() {
    const issuanceNumber = $('#docIssuanceNumber').val().trim();
    const documentType = $('#docType').val();
    const subject = $('#docSubject').val().trim();
    const datePosted = $('#docDatePosted').val();
    const fileSelected = window.selectedPdfFile !== null;
    
    const isComplete = issuanceNumber && documentType && subject && datePosted && fileSelected;
    
    console.log('Form completion check:', {
        issuanceNumber: !!issuanceNumber,
        documentType: !!documentType,
        subject: !!subject,
        datePosted: !!datePosted,
        fileSelected: fileSelected,
        isComplete: isComplete
    });
    
    $('#startUploadBtn').prop('disabled', !isComplete);
    return isComplete;
}

// View PDF Preview function
function viewPdfPreview() {
    console.log('View PDF Preview clicked');
    
    if (!window.selectedPdfFile) {
        alert('Please select a PDF file first');
        return;
    }
    
    try {
        // Create a URL for the selected file
        const fileURL = URL.createObjectURL(window.selectedPdfFile);
        
        // Open PDF in a new window/tab
        const newWindow = window.open(fileURL, '_blank', 'width=800,height=600,scrollbars=yes,resizable=yes');
        
        if (!newWindow) {
            // If popup was blocked, show alternative
            alert('Popup blocked. Please allow popups for this site to view PDF preview.');
            
            // Alternative: Create a download link
            const link = document.createElement('a');
            link.href = fileURL;
            link.download = window.selectedPdfFile.name;
            link.textContent = 'Click to download and view PDF';
            
            // Show in a modal or alert
            const message = `PDF preview blocked. You can download the file to view it: ${window.selectedPdfFile.name}`;
            alert(message);
        } else {
            console.log('PDF preview opened in new window');
            
            // Clean up the URL after some time
            setTimeout(() => {
                URL.revokeObjectURL(fileURL);
            }, 60000); // Clean up after 1 minute
        }
        
    } catch (error) {
        console.error('Error opening PDF preview:', error);
        alert('Unable to preview PDF. Error: ' + error.message);
    }
}

// Global function to trigger file input (accessible from HTML)
function triggerFileInput() {
    console.log('triggerFileInput function called');
    
    // Check if file input exists
    const fileInput = document.getElementById('fileInput');
    if (!fileInput) {
        console.log('ERROR: File input not found with getElementById');
        
        // Try jQuery selector as fallback
        const jQueryFileInput = $('#fileInput')[0];
        if (!jQueryFileInput) {
            console.log('ERROR: File input not found with jQuery either');
            alert('File input not found! Please check if the modal is open.');
            return;
        } else {
            console.log('File input found with jQuery, using that');
            jQueryFileInput.click();
            return;
        }
    }
    
    console.log('File input found, triggering click');
    console.log('File input element:', fileInput);
    console.log('File input accept attribute:', fileInput.accept);
    
    // Try to trigger the click
    try {
        fileInput.click();
        console.log('File input click triggered successfully');
    } catch (error) {
        console.error('Error triggering file input click:', error);
        alert('Error opening file dialog: ' + error.message);
    }
}

// PDF Upload Module - File validation and handling
$(document).ready(function() {
    console.log('Document ready, setting up PDF upload functionality');
    
    // Choose File button click handler
    $(document).on('click', '#chooseFileBtn', function(e) {
        e.preventDefault();
        console.log('Choose File button clicked');
        
        // Trigger the hidden file input
        const fileInput = document.getElementById('pdfFileInput');
        if (fileInput) {
            console.log('PDF file input found, opening file dialog');
            fileInput.click();
        } else {
            console.error('PDF file input not found');
            alert('File input not found. Please refresh the page and try again.');
        }
    });
    
    // File input change handler
    $(document).on('change', '#pdfFileInput', function(e) {
        console.log('File input changed');
        
        const file = e.target.files[0];
        if (file) {
            console.log('File selected:', file.name, 'Size:', file.size, 'Type:', file.type);
            
            // Validate the selected file
            if (validateFile(file)) {
                // File is valid, display it and enable form
                displaySelectedFile(file);
                enableDocumentForm();
                
                // Store the file for later use
                window.selectedPdfFile = file;
            } else {
                // File is invalid, clear selection
                console.log('File validation failed');
                e.target.value = ''; // Clear the file input
                window.selectedPdfFile = null;
            }
        } else {
            // No file selected
            console.log('No file selected');
            resetFileSelection();
        }
    });
    
    // Initialize form state
    disableDocumentForm();
    
    console.log('PDF upload functionality initialized successfully');
});

// Reset file selection state
function resetFileSelection() {
    console.log('Resetting file selection');
    
    // Clear file display
    const fileNameElement = document.getElementById('selectedFileName');
    if (fileNameElement) {
        fileNameElement.textContent = 'No file selected';
        fileNameElement.className = 'text-muted';
    }
    
    // Hide file info
    const fileInfoElement = document.getElementById('fileInfo');
    if (fileInfoElement) {
        fileInfoElement.style.display = 'none';
    }
    
    // Clear errors
    clearFileError();
    
    // Disable form
    disableDocumentForm();
    
    // Clear stored file
    window.selectedPdfFile = null;
}

// File validation functions
function validateFile(file) {
    console.log('Validating file:', file.name);
    
    // Reset previous errors
    clearFileError();
    
    // Check file extension
    if (!file.name.toLowerCase().endsWith('.pdf')) {
        showFileError('Only PDF files are allowed');
        return false;
    }
    
    // Check file size (10MB = 10 * 1024 * 1024 bytes)
    const maxSize = 10 * 1024 * 1024;
    if (file.size > maxSize) {
        showFileError('File size exceeds 10MB limit');
        return false;
    }
    
    // Check MIME type for additional security
    if (file.type && file.type !== 'application/pdf') {
        showFileError('Invalid file type. Only PDF files are allowed');
        return false;
    }
    
    console.log('File validation passed');
    return true;
}

function showFileError(message) {
    console.log('Showing file error:', message);
    
    // Display error message
    const errorElement = document.getElementById('fileError');
    if (errorElement) {
        errorElement.textContent = message;
        errorElement.style.display = 'block';
    }
    
    // Update file name display to show error state
    const fileNameElement = document.getElementById('selectedFileName');
    if (fileNameElement) {
        fileNameElement.textContent = message;
        fileNameElement.className = 'text-danger';
    }
    
    // Hide file info
    const fileInfoElement = document.getElementById('fileInfo');
    if (fileInfoElement) {
        fileInfoElement.style.display = 'none';
    }
    
    // Keep form disabled
    disableDocumentForm();
}

function clearFileError() {
    console.log('Clearing file error');
    
    // Hide error message
    const errorElement = document.getElementById('fileError');
    if (errorElement) {
        errorElement.style.display = 'none';
        errorElement.textContent = '';
    }
    
    // Reset file name display
    const fileNameElement = document.getElementById('selectedFileName');
    if (fileNameElement) {
        fileNameElement.className = 'text-muted';
    }
}

function displaySelectedFile(file) {
    console.log('Displaying selected file:', file.name);
    
    // Show file name
    const fileNameElement = document.getElementById('selectedFileName');
    if (fileNameElement) {
        fileNameElement.textContent = file.name;
        fileNameElement.className = 'text-success';
    }
    
    // Show file info with size
    const fileInfoElement = document.getElementById('fileInfo');
    const fileNameSpan = document.getElementById('fileName');
    const fileSizeSpan = document.getElementById('fileSize');
    
    if (fileInfoElement && fileNameSpan && fileSizeSpan) {
        fileNameSpan.textContent = file.name;
        fileSizeSpan.textContent = `(${formatFileSize(file.size)})`;
        fileInfoElement.style.display = 'block';
    }
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

function disableDocumentForm() {
    console.log('Disabling document form');
    
    // Disable form fields
    $('#docIssuanceNumber').prop('disabled', true);
    $('#docType').prop('disabled', true);
    $('#docSubject').prop('disabled', true);
    $('#docDatePosted').prop('disabled', true);
    $('#startUploadBtn').prop('disabled', true);
}

function enableDocumentForm() {
    console.log('Enabling document form');
    
    // Enable form fields
    $('#docIssuanceNumber').prop('disabled', false);
    $('#docType').prop('disabled', false);
    $('#docSubject').prop('disabled', false);
    $('#docDatePosted').prop('disabled', false);
    
    // Add form field change handlers to check completion
    $('#docIssuanceNumber, #docType, #docSubject, #docDatePosted').on('input change', function() {
        checkFormCompletion();
    });
    
    // Upload button will be enabled when form is complete
    checkFormCompletion();
}

// Duplicate function removed - using the one defined earlier

// Global function to open upload modal (accessible from HTML)
function openUploadModal() {
    console.log('openUploadModal function called');
    
    // Check if modal exists
    if ($('#uploadModal').length === 0) {
        console.log('ERROR: Modal not found in DOM');
        alert('Modal not found! Please check the HTML structure.');
        return;
    }
    
    // Try to show the modal
    try {
        // Try Bootstrap 4 method (most likely what's being used)
        $('#uploadModal').modal('show');
        console.log('Bootstrap 4 modal show executed');
    } catch (error) {
        console.log('Bootstrap 4 modal error:', error);
        
        // Manual fallback
        $('#uploadModal').addClass('show').css('display', 'block');
        $('body').addClass('modal-open').append('<div class="modal-backdrop fade show"></div>');
        console.log('Manual modal show executed');
    }
    
    // Reset modal content if the function exists
    if (typeof resetUploadModal === 'function') {
        try {
            resetUploadModal();
        } catch (error) {
            console.log('Reset modal error:', error);
        }
    }
}
</script>
@endpush
