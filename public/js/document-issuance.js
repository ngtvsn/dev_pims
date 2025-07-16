// Document Issuance Page JavaScript

// Sample data for demonstration
const sampleDocuments = [
    {
        id: 1,
        subject: "Annual Budget Review",
        classification: "Memorandum",
        issuanceNumber: 101,
        datePosted: "2025-06-15",
        content: "Annual budget review for fiscal year 2025-2026"
    },
    {
        id: 2,
        subject: "Staff Promotion Guidelines",
        classification: "PITAHC Personnel Order",
        issuanceNumber: 102,
        datePosted: "2025-06-10",
        content: "Updated guidelines for staff promotion and evaluation"
    },
    {
        id: 3,
        subject: "New Equipment Procurement",
        classification: "PITAHC Order",
        issuanceNumber: 103,
        datePosted: "2025-06-05",
        content: "Approval for procurement of new laboratory equipment"
    },
    {
        id: 4,
        subject: "COVID-19 Safety Protocols",
        classification: "Memorandum",
        issuanceNumber: 104,
        datePosted: "2025-05-28",
        content: "Updated safety protocols for COVID-19 prevention"
    },
    {
        id: 5,
        subject: "Holiday Schedule",
        classification: "PITAHC Personnel Order",
        issuanceNumber: 105,
        datePosted: "2025-05-20",
        content: "Official holiday schedule for the remainder of 2025"
    }
];

// Store the current documents in memory
let currentDocuments = [...sampleDocuments];

// Initialize DataTable
let dataTable;

$(document).ready(function () {
    // Set up module type dropdown with enhanced styling
    const moduleTypeDropdown = $('#moduleType');
    moduleTypeDropdown.on('change', function () {
        // Visual feedback when selection changes
        if ($(this).val()) {
            $(this).addClass('border-primary');
        } else {
            $(this).removeClass('border-primary');
        }

        // Auto-apply filter when dropdown changes (optional feature)
        // Uncomment the line below to enable auto-filtering
        // applyFilters();
    });

    // Set up search text area with enhanced functionality
    const searchTextInput = $('#searchText');
    let searchTimeout;

    searchTextInput.on('input', function () {
        // Visual feedback when text is entered
        if ($(this).val()) {
            $(this).addClass('border-primary');
        } else {
            $(this).removeClass('border-primary');
        }

        // Debounce search to avoid excessive filtering while typing
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function () {
            // Uncomment the line below to enable auto-filtering while typing
            // applyFilters();
        }, 500);
    });

    // Add keyboard shortcut (Ctrl+Enter) to trigger search
    searchTextInput.on('keydown', function (e) {
        if (e.ctrlKey && e.key === 'Enter') {
            applyFilters();
        }
    });

    // Set up issuance number field with validation
    const issuanceNumberInput = $('#issuanceNumber');

    issuanceNumberInput.on('input', function () {
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
    issuanceNumberInput.on('keypress', function (e) {
        // Allow only digits (0-9) and control keys
        if (e.which < 48 || e.which > 57) {
            e.preventDefault();
        }
    });

    // Set up date range fields with validation
    const dateFromInput = $('#dateFrom');
    const dateToInput = $('#dateTo');

    // Add visual feedback when dates are selected
    dateFromInput.on('change', function () {
        if ($(this).val()) {
            $(this).addClass('border-primary');
        } else {
            $(this).removeClass('border-primary');
        }
        validateDateRange();
    });

    dateToInput.on('change', function () {
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
                data: 'subject',
                render: function (data, type, row) {
                    if (type === 'display') {
                        return `<span class="fw-medium">${data}</span>
                                <div class="small text-muted">Issuance #${row.issuanceNumber}</div>`;
                    }
                    return data;
                }
            },
            {
                data: 'classification',
                render: function (data) {
                    let badgeClass = 'bg-secondary';
                    if (data === 'Memorandum') badgeClass = 'bg-info';
                    if (data === 'PITAHC Personnel Order') badgeClass = 'bg-warning';
                    if (data === 'PITAHC Order') badgeClass = 'bg-primary';

                    return `<span class="badge ${badgeClass}">${data}</span>`;
                }
            },
            {
                data: 'datePosted',
                render: function (data) {
                    const date = new Date(data);
                    return `<span>${date.toLocaleDateString()}</span>
                            <div class="small text-muted">${date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</div>`;
                }
            },
            {
                data: null,
                orderable: false,
                className: 'text-center',
                render: function (data, type, row) {
                    return `
                        <div class="btn-group" role="group" aria-label="Document actions">
                            <button class="btn btn-sm btn-outline-primary action-btn edit-btn" data-id="${row.id}" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger action-btn delete-btn" data-id="${row.id}" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;
                }
            }
        ],
        responsive: true,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        pageLength: 10,
        dom: '<"row"<"col-sm-6"l><"col-sm-6"f>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
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
        drawCallback: function () {
            // Update document count after table is drawn
            updateDocumentCount(this.api().page.info().recordsDisplay);
        }
    });

    // Search button click handler
    $('#searchBtn').on('click', function () {
        applyFilters();
    });

    // Clear button click handler
    $('#clearBtn').on('click', function () {
        clearFilters();
    });

    // Upload button click handler
    // Test the file input directly
window.debugUpload.testFileInput()

// Test the modal
window.debugUpload.testModal()

// Test the button
window.debugUpload.testButton()
    $('#uploadBtn').on('click', function (e) {
        console.log('Upload button clicked'); // Debug log
        e.preventDefault(); // Prevent any default behavior

        const fileInput = $('#fileInput')[0]; // Get the DOM element
        if (fileInput) {
            console.log('File input found, triggering click');
            fileInput.click(); // Use native DOM click method
        } else {
            console.error('File input not found');
        }
    });

    // File input change handler
    $('#fileInput').on('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            handleFileUpload(file);
        }
    });

    // Drag and drop functionality
    const uploadArea = $('.upload-area');

    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.on(eventName, function (e) {
            e.preventDefault();
            e.stopPropagation();
        });
    });

    // Highlight drop area when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.on(eventName, function () {
            $(this).addClass('border-success bg-light-success');
        });
    });

    // Remove highlight when item is dragged out or dropped
    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.on(eventName, function () {
            $(this).removeClass('border-success bg-light-success');
        });
    });

    // Handle dropped files
    uploadArea.on('drop', function (e) {
        const droppedFile = e.originalEvent.dataTransfer.files[0];
        if (droppedFile) {
            handleFileUpload(droppedFile);
        }
    });

    // Date validation
    $('#dateFrom, #dateTo').on('change', function () {
        validateDateRange();
    });

    // Edit button click handler (using event delegation)
    $('#issuanceTable').on('click', '.edit-btn', function () {
        const documentId = $(this).data('id');
        handleEditDocument(documentId);
    });

    // Delete button click handler (using event delegation)
    $('#issuanceTable').on('click', '.delete-btn', function () {
        const documentId = $(this).data('id');
        showDeleteConfirmation(documentId);
    });

    // Confirm delete button click handler
    $('#confirmDelete').on('click', function () {
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
    searchBtn.html('<i class="fas fa-spinner fa-spin me-1"></i>Searching...').prop('disabled', true);

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

    // Simulate a slight delay for better UX (remove in production)
    setTimeout(() => {
        // Filter the documents
        const filteredDocuments = sampleDocuments.filter(doc => {
            // Filter by module type
            if (moduleType && doc.classification !== moduleType) {
                return false;
            }

            // Filter by search text
            if (searchText && !doc.subject.toLowerCase().includes(searchText) &&
                !doc.content.toLowerCase().includes(searchText)) {
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

        // Show filter summary
        showFilterSummary(moduleType, searchText, issuanceNumber, dateFrom, dateTo, filteredDocuments.length);
    }, 300);
}

// Show a summary of applied filters
function showFilterSummary(moduleType, searchText, issuanceNumber, dateFrom, dateTo, resultCount) {
    let summaryText = `Found ${resultCount} document(s)`;

    if (moduleType || searchText || issuanceNumber || dateFrom || dateTo) {
        summaryText += ' with filters:';

        if (moduleType) {
            summaryText += ` Type="${moduleType}"`;
        }

        if (searchText) {
            summaryText += ` Text="${searchText}"`;
        }

        if (issuanceNumber) {
            summaryText += ` Number=${issuanceNumber}`;
        }

        if (dateFrom) {
            summaryText += ` From=${dateFrom.toLocaleDateString()}`;
        }

        if (dateTo) {
            summaryText += ` To=${dateTo.toLocaleDateString()}`;
        }
    }

    // Create or update filter summary element
    if ($('#filterSummary').length === 0) {
        $('.table-responsive').before(`<div id="filterSummary" class="alert alert-info mb-3">${summaryText}</div>`);
    } else {
        $('#filterSummary').text(summaryText).show();
    }
}

// Clear all filters
function clearFilters() {
    // Show loading indicator
    const clearBtn = $('#clearBtn');
    const originalClearBtnHtml = clearBtn.html();
    clearBtn.html('<i class="fas fa-spinner fa-spin me-1"></i>Clearing...').prop('disabled', true);

    // Reset all form fields
    $('#moduleType').val('').removeClass('border-primary');
    $('#searchText').val('').removeClass('border-primary');
    $('#issuanceNumber').val('').removeClass('border-primary is-invalid');
    $('#dateFrom').val('').removeClass('border-primary is-invalid');
    $('#dateTo').val('').removeClass('border-primary is-invalid');

    // Hide error messages
    $('#dateError').hide();
    $('#issuanceNumberError').hide();

    // Simulate a slight delay for better UX (remove in production)
    setTimeout(() => {
        // Reset to all documents
        updateDataTable(sampleDocuments);

        // Restore clear button
        clearBtn.html(originalClearBtnHtml).prop('disabled', false);

        // Hide filter summary
        $('#filterSummary').hide();
    }, 300);
}

// Update the data table with new data
function updateDataTable(documents) {
    currentDocuments = [...documents];
    dataTable.clear();
    dataTable.rows.add(documents);
    dataTable.draw();
}

// Validate date range
function validateDateRange() {
    const dateFrom = $('#dateFrom').val() ? new Date($('#dateFrom').val()) : null;
    const dateTo = $('#dateTo').val() ? new Date($('#dateTo').val()) : null;

    if (dateFrom && dateTo && dateFrom > dateTo) {
        $('#dateError').removeClass('d-none');
        return false;
    } else {
        $('#dateError').addClass('d-none');
        return true;
    }
}

// Handle file upload
function handleFileUpload(file) {
    // Check file type (this is a simple check, can be expanded)
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
    $('#uploadBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Uploading...');

    // Simulate upload process with progress updates
    let progress = 0;
    const progressInterval = setInterval(() => {
        progress += 10;
        progressBarInner.css('width', progress + '%').attr('aria-valuenow', progress);

        if (progress >= 100) {
            clearInterval(progressInterval);

            // Simulate server processing time
            setTimeout(() => {
                // In a real application, you would send the file to the server here
                // For demo purposes, we'll just show a success message
                showUploadSuccess('File uploaded successfully: ' + file.name);

                // Reset file input and progress bar
                $('#fileInput').val('');
                progressBar.addClass('d-none');

                // Re-enable upload button
                $('#uploadBtn').prop('disabled', false).html('<i class="fas fa-upload me-2"></i>Upload');

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
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editForm">
                                    <input type="hidden" id="editDocumentId">
                                    <div class="mb-3">
                                        <label for="editSubject" class="form-label">Subject</label>
                                        <input type="text" class="form-control" id="editSubject" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editClassification" class="form-label">Classification</label>
                                        <select class="form-select" id="editClassification" required>
                                            <option value="Memorandum">Memorandum</option>
                                            <option value="PITAHC Personnel Order">PITAHC Personnel Order</option>
                                            <option value="PITAHC Order">PITAHC Order</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editIssuanceNumber" class="form-label">Issuance Number</label>
                                        <input type="number" class="form-control" id="editIssuanceNumber" required min="1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editDatePosted" class="form-label">Date Posted</label>
                                        <input type="date" class="form-control" id="editDatePosted" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editContent" class="form-label">Content</label>
                                        <textarea class="form-control" id="editContent" rows="3" required></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="saveEditBtn">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            $('body').append(modalHtml);

            // Add save button handler
            $('#saveEditBtn').on('click', function () {
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
        const editModal = new bootstrap.Modal(document.getElementById('editModal'));
        editModal.show();
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
            showToast('Document updated successfully', 'success');
        }
    } catch (error) {
        console.error('Error updating document:', error);
        showToast('Unable to update document. Please try again.', 'error');
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
        deleteBtn.html('<i class="fas fa-spinner fa-spin me-1"></i>Deleting...').prop('disabled', true);

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
                showToast('Document deleted successfully', 'success');
            }

            // Restore delete button
            deleteBtn.html(originalDeleteBtnHtml).prop('disabled', false);
        }, 500);
    } catch (error) {
        console.error('Error deleting document:', error);
        showToast('Unable to delete document. Please try again.', 'error');

        // Restore delete button
        $('#confirmDelete').html('Delete').prop('disabled', false);
    }
}

// Show toast message
function showToast(message, type = 'info') {
    // Create toast container if it doesn't exist
    if ($('#toastContainer').length === 0) {
        $('body').append('<div id="toastContainer" class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050;"></div>');
    }

    // Set toast color based on type
    let bgClass = 'bg-info';
    if (type === 'success') bgClass = 'bg-success';
    if (type === 'error') bgClass = 'bg-danger';
    if (type === 'warning') bgClass = 'bg-warning';

    // Create unique ID for this toast
    const toastId = 'toast-' + Date.now();

    // Create toast HTML
    const toastHtml = `
        <div id="${toastId}" class="toast align-items-center ${bgClass} text-white border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    `;

    // Add toast to container
    $('#toastContainer').append(toastHtml);

    // Initialize and show toast
    const toastElement = document.getElementById(toastId);
    const toast = new bootstrap.Toast(toastElement, { delay: 3000 });
    toast.show();

    // Remove toast element after it's hidden
    $(toastElement).on('hidden.bs.toast', function () {
        $(this).remove();
    });
}
//
 Update document count badge
function updateDocumentCount(count) {
    $('#documentCount').text(count + (count === 1 ? ' document' : ' documents'));
}

// Update data table with empty state handling
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
}//
 Responsive behavior adjustments
$(window).on('resize', function () {
    // Adjust DataTable columns visibility based on screen size
    const windowWidth = $(window).width();

    if (windowWidth < 768) {
        // On small screens, simplify the table
        dataTable.column(1).visible(false); // Hide Classification column
    } else {
        // On larger screens, show all columns
        dataTable.column(1).visible(true);
    }

    // Redraw the table to apply changes
    dataTable.columns.adjust().draw();
});

// Trigger resize handler on initial load
$(window).trigger('resize');

// Enhance touch interaction for mobile devices
if ('ontouchstart' in window) {
    // Add touch-friendly classes
    $('body').addClass('touch-device');

    // Make buttons larger on touch devices
    $('.btn').addClass('touch-friendly');

    // Add CSS for touch-friendly elements
    const touchStyles = `
        <style>
            .touch-friendly {
                min-height: 44px;
                min-width: 44px;
            }
            .touch-device .form-control,
            .touch-device .form-select {
                padding: 0.5rem 0.75rem;
                height: calc(1.5em + 1rem + 2px);
            }
            .touch-device .action-btn {
                padding: 0.375rem 0.75rem;
            }
        </style>
    `;
    $('head').append(touchStyles);
}// En
hance keyboard navigation and accessibility
$(document).ready(function () {
    // Add keyboard shortcuts for common actions
    $(document).on('keydown', function (e) {
        // Alt+F to focus on filter form (Alt+Shift+F)
        if (e.altKey && e.shiftKey && e.key === 'F') {
            e.preventDefault();
            $('#moduleType').focus();
        }

        // Alt+S to focus on search button (Alt+Shift+S)
        if (e.altKey && e.shiftKey && e.key === 'S') {
            e.preventDefault();
            $('#searchBtn').focus();
        }

        // Alt+C to focus on clear button (Alt+Shift+C)
        if (e.altKey && e.shiftKey && e.key === 'C') {
            e.preventDefault();
            $('#clearBtn').focus();
        }

        // Alt+U to focus on upload button (Alt+Shift+U)
        if (e.altKey && e.shiftKey && e.key === 'U') {
            e.preventDefault();
            $('#uploadBtn').focus();
        }

        // Alt+T to focus on table (Alt+Shift+T)
        if (e.altKey && e.shiftKey && e.key === 'T') {
            e.preventDefault();
            $('#issuanceTable_filter input').focus();
        }
    });

    // Enhance focus styles for better keyboard navigation
    const focusStyles = `
        <style>
            :focus {
                outline: 2px solid #3498db !important;
                outline-offset: 2px !important;
            }
            
            .btn:focus, .form-control:focus, .form-select:focus {
                box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.5) !important;
            }
            
            .skip-link {
                position: absolute;
                top: -40px;
                left: 0;
                background: #3498db;
                color: white;
                padding: 8px;
                z-index: 100;
                transition: top 0.3s;
            }
            
            .skip-link:focus {
                top: 0;
            }
        </style>
    `;
    $('head').append(focusStyles);

    // Add skip link for keyboard users
    $('body').prepend('<a href="#main-content" class="skip-link">Skip to main content</a>');
    $('.container-fluid').attr('id', 'main-content').attr('tabindex', '-1');

    // Add keyboard support for action buttons in table
    $('#issuanceTable').on('keydown', '.action-btn', function (e) {
        // Press Enter or Space to click the button
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            $(this).click();
        }
    });

    // Make sure all interactive elements are focusable
    $('.action-btn').attr('tabindex', '0');

    // Add keyboard instructions
    const keyboardHelpHtml = `
        <div class="mt-4 mb-2">
            <details>
                <summary class="text-primary" style="cursor: pointer;">Keyboard Shortcuts</summary>
                <div class="card mt-2">
                    <div class="card-body">
                        <ul class="mb-0">
                            <li>Alt+Shift+F: Focus on filter form</li>
                            <li>Alt+Shift+S: Focus on search button</li>
                            <li>Alt+Shift+C: Focus on clear button</li>
                            <li>Alt+Shift+U: Focus on upload button</li>
                            <li>Alt+Shift+T: Focus on table search</li>
                            <li>Tab: Navigate between elements</li>
                            <li>Enter/Space: Activate buttons</li>
                        </ul>
                    </div>
                </div>
            </details>
        </div>
    `;
    $('.container-fluid > h1').after(keyboardHelpHtml);
});// P
erformance optimizations
$(document).ready(function () {
    // Debounce function to limit the rate at which a function can fire
    function debounce(func, wait) {
        let timeout;
        return function () {
            const context = this;
            const args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                func.apply(context, args);
            }, wait);
        };
    }

    // Use debounced handlers for expensive operations
    const debouncedResize = debounce(function () {
        // Adjust DataTable columns visibility based on screen size
        const windowWidth = $(window).width();

        if (windowWidth < 768) {
            // On small screens, simplify the table
            dataTable.column(1).visible(false); // Hide Classification column
        } else {
            // On larger screens, show all columns
            dataTable.column(1).visible(true);
        }

        // Redraw the table to apply changes
        dataTable.columns.adjust().draw();
    }, 250);

    // Replace the original resize handler with the debounced version
    $(window).off('resize').on('resize', debouncedResize);

    // Optimize DataTables for performance
    $.extend($.fn.dataTable.defaults, {
        deferRender: true,
        scroller: true,
        stateSave: true
    });

    // Lazy load images
    if ('loading' in HTMLImageElement.prototype) {
        // Browser supports native lazy loading
        document.querySelectorAll('img').forEach(img => {
            img.setAttribute('loading', 'lazy');
        });
    }

    // Use event delegation for common events
    // This replaces multiple event handlers with a single delegated handler
    $('#filterForm').on('change', 'select, input', function () {
        const $this = $(this);

        // Visual feedback when value changes
        if ($this.val()) {
            $this.addClass('border-primary');
        } else {
            $this.removeClass('border-primary');
        }
    });

    // Clean up event listeners when elements are removed from DOM
    $(document).on('hidden.bs.modal', '.modal', function () {
        $(this).find('input, select, textarea').off();
    });
});