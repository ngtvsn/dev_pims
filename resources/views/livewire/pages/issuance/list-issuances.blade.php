<div>
    <!-- Custom Styles -->
    <style>
        :root {
            --primary-blue: #1e40af;
            --emerald-accent: #10b981;
            --amber-accent: #f59e0b;
            --modern-gray: #6b7280;
            --light-gray: #f8fafc;
            --border-radius: 12px;
            --shadow-elegant: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-premium: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .issuance-container {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }

        .premium-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-elegant);
            border: 1px solid #e2e8f0;
            transition: var(--transition-smooth);
            overflow: hidden;
            position: relative;
        }

        .premium-card:hover {
            box-shadow: var(--shadow-premium);
            transform: translateY(-2px);
        }

        .premium-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue), var(--emerald-accent));
        }

        .card-header-modern {
            background: linear-gradient(135deg, var(--primary-blue) 0%, #3b82f6 100%);
            color: white;
            padding: 1.5rem;
            border: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header-modern h3 {
            margin: 0;
            font-weight: 600;
            font-size: 1.125rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-form {
            padding: 2rem;
            background: white;
        }

        .filter-section {
            background: #f8fafc;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--primary-blue);
        }

        .filter-section-title {
            font-weight: 600;
            color: var(--primary-blue);
            margin-bottom: 1rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group-modern {
            margin-bottom: 1.5rem;
        }

        .form-label-modern {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            display: block;
            font-size: 0.875rem;
        }

        .form-control-modern {
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            transition: var(--transition-smooth);
            background: white;
        }

        .form-control-modern:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
            outline: none;
        }

        .btn-modern {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            transition: var(--transition-smooth);
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary-modern {
            background: linear-gradient(135deg, var(--primary-blue) 0%, #3b82f6 100%);
            color: white;
        }

        .btn-primary-modern:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-elegant);
        }

        .btn-secondary-modern {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .btn-secondary-modern:hover {
            background: #e5e7eb;
        }

        .data-table {
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .table-modern {
            margin: 0;
            width: 100%;
        }

        .table-modern thead {
            background: #f8fafc;
        }

        .table-modern th {
            padding: 1rem;
            font-weight: 600;
            color: #374151;
            border-bottom: 2px solid #e5e7eb;
            font-size: 0.875rem;
            cursor: pointer;
            transition: var(--transition-smooth);
        }

        .table-modern th:hover {
            background: #f1f5f9;
        }

        .table-modern td {
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .table-modern tbody tr {
            transition: var(--transition-smooth);
        }

        .table-modern tbody tr:hover {
            background: #f8fafc;
        }

        .badge-modern {
            padding: 0.375rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .badge-primary { background: #dbeafe; color: #1e40af; }
        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-secondary { background: #f3f4f6; color: #374151; }

        .action-btn {
            padding: 0.5rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: var(--transition-smooth);
            margin: 0 0.25rem;
        }

        .action-btn-edit {
            background: #dbeafe;
            color: #1e40af;
        }

        .action-btn-delete {
            background: #fee2e2;
            color: #dc2626;
        }

        .action-btn:hover {
            transform: scale(1.1);
        }

        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }

        .spinner {
            width: 2rem;
            height: 2rem;
            border: 3px solid #e5e7eb;
            border-top: 3px solid var(--primary-blue);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--modern-gray);
        }

        .pagination-modern {
            display: flex;
            justify-content: between;
            align-items: center;
            padding: 1.5rem;
            background: #f8fafc;
            border-top: 1px solid #e5e7eb;
        }

        .results-counter {
            font-size: 0.875rem;
            color: var(--modern-gray);
        }

        .document-cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
            padding: 1.5rem;
        }

        .document-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-elegant);
            border: 1px solid #e2e8f0;
            transition: var(--transition-smooth);
            overflow: hidden;
        }

        .document-card:hover {
            box-shadow: var(--shadow-premium);
            transform: translateY(-2px);
        }

        .document-card-header {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .document-number {
            font-weight: 600;
            color: var(--primary-blue);
            font-size: 0.875rem;
            background: white;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }

        .document-actions {
            display: flex;
            gap: 0.5rem;
        }

        .document-card-body {
            padding: 1.25rem;
        }

        .document-title {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1rem;
            line-height: 1.4;
            font-size: 1rem;
        }

        .document-meta {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .meta-label {
            font-weight: 500;
            color: var(--modern-gray);
            font-size: 0.875rem;
            min-width: 40px;
        }

        .meta-value {
            color: #374151;
            font-size: 0.875rem;
        }

        .empty-state-card {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem;
            color: var(--modern-gray);
            background: white;
            border-radius: var(--border-radius);
            border: 2px dashed #e2e8f0;
        }

        @media (max-width: 768px) {
            .issuance-container {
                padding: 1rem 0;
            }
            
            .filter-form {
                padding: 1rem;
            }
            
            .document-cards-container {
                grid-template-columns: 1fr;
                padding: 1rem;
                gap: 1rem;
            }
            
            .document-card-header {
                padding: 0.75rem 1rem;
            }
            
            .document-card-body {
                padding: 1rem;
            }
        }
    </style>

    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark" style="font-weight: 700; color: var(--primary-blue) !important;">
                        <i class="fas fa-bullhorn mr-2"></i>Document Issuances
                    </h1>
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

    <!-- Main Content -->
    <div class="content issuance-container">
        <div class="container-fluid">
            <div class="row">
                <!-- Left Column: Filter Panel -->
                <div class="col-lg-3 col-md-12 mb-4">
                    <div class="premium-card">
                        <div class="card-header-modern">
                            <h3><i class="fas fa-filter"></i>Filter Documents</h3>
                        </div>
                        <div class="filter-form">
                            <!-- Document Classification Section -->
                            <div class="filter-section">
                                <div class="filter-section-title">
                                    <i class="fas fa-tags mr-2"></i>Document Classification
                                </div>
                                <div class="form-group-modern mb-0">
                                    <label class="form-label-modern mb-1" style="font-size: 0.875rem;">Document Type</label>
                                    <select wire:model="documentTypeFilter" class="form-control-modern" style="padding: 0.375rem 0.75rem; font-size: 0.875rem;">
                                        <option value="">All Types</option>
                                        @foreach($documentSubTypes as $subType)
                                            <option value="{{ $subType->id }}">{{ $subType->document_sub_type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Content Search Section -->
                            <div class="filter-section">
                                <div class="filter-section-title">
                                    <i class="fas fa-search mr-2"></i>Content Search
                                </div>
                                <div class="form-group-modern mb-3">
                                    <label class="form-label-modern mb-1" style="font-size: 0.875rem;">Subject Search</label>
                                    <textarea wire:model.debounce.500ms="subjectSearch" 
                                              class="form-control-modern" 
                                              style="padding: 0.375rem 0.75rem; font-size: 0.875rem; min-height: 60px; resize: vertical;"
                                              rows="2"
                                              placeholder="Enter document subject..."></textarea>
                                </div>
                                <div class="form-group-modern mb-0">
                                    <label class="form-label-modern mb-1" style="font-size: 0.875rem;">Issuance Number</label>
                                    <input type="text" wire:model.debounce.500ms="issuanceNumber" 
                                           class="form-control-modern" 
                                           style="padding: 0.375rem 0.75rem; font-size: 0.875rem;"
                                           placeholder="Enter issuance number...">
                                </div>
                            </div>

                            <!-- Date Range Section -->
                            <div class="filter-section">
                                <div class="filter-section-title">
                                    <i class="fas fa-calendar mr-2"></i>Date Range
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <div class="form-group-modern mb-2">
                                            <label class="form-label-modern mb-1" style="font-size: 0.875rem;">From Date</label>
                                            <input type="date" wire:model="dateFrom" class="form-control-modern" style="padding: 0.375rem 0.75rem; font-size: 0.875rem;">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-0">
                                        <div class="form-group-modern mb-0">
                                            <label class="form-label-modern mb-1" style="font-size: 0.875rem;">To Date</label>
                                            <input type="date" wire:model="dateTo" class="form-control-modern" style="padding: 0.375rem 0.75rem; font-size: 0.875rem;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" wire:click="clearFilters" class="btn-modern btn-secondary-modern w-100" style="padding: 0.5rem; font-size: 0.875rem;">
                                        <i class="fas fa-times"></i> Clear
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="button" wire:click="searchDocuments" class="btn-modern btn-primary-modern w-100" style="padding: 0.5rem; font-size: 0.875rem;">
                                        <i class="fas fa-search"></i> Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Data Table -->
                <div class="col-lg-9 col-md-12">
                    <div class="premium-card data-table" style="position: relative;">
                        <!-- Loading Overlay -->
                        @if($loading)
                            <div class="loading-overlay">
                                <div class="spinner"></div>
                            </div>
                        @endif

                        <div class="card-header-modern">
                            <h3><i class="fas fa-folder-open"></i>Document Issuance Records</h3>
                            <div class="d-flex align-items-center gap-3">
                                <span class="results-counter" style="color: rgba(255,255,255,0.8);">
                                    {{ $totalDocuments }} {{ Str::plural('record', $totalDocuments) }}
                                </span>
                            </div>
                        </div>

                        <!-- Pagination Controls -->
                        <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                            <div class="form-group-modern mb-0">
                                <label class="form-label-modern mb-1">Per Page</label>
                                <select wire:model="perPage" class="form-control-modern" style="width: auto; display: inline-block;">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                        </div>

                        <!-- Document Cards Grid -->
                        <div class="document-cards-container">
                            @forelse($documents as $document)
                                <div class="document-card">
                                    <div class="document-card-header">
                                        <div class="document-number">
                                            {{ $document->document_reference_code ?: 'DOC-' . str_pad($document->id, 4, '0', STR_PAD_LEFT) }}
                                        </div>
                                        <div class="document-actions">
                                            <button class="action-btn action-btn-edit" title="Edit Document">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button wire:click="confirmDelete({{ $document->id }})" 
                                                    class="action-btn action-btn-delete" 
                                                    title="Delete Document">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="document-card-body">
                                        <h6 class="document-title">{{ $document->document_title ?: 'Untitled Document' }}</h6>
                                        <div class="document-meta">
                                            <div class="meta-item">
                                                <span class="meta-label">Type:</span>
                                                <span class="badge-modern badge-primary">
                                                    {{ $document->documentSubType->document_sub_type_name ?? 'General' }}
                                                </span>
                                            </div>
                                            <div class="meta-item">
                                                <span class="meta-label">Document Date:</span>
                                                <span class="meta-value">{{ $document->formatted_date }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="empty-state-card">
                                    <i class="fas fa-inbox fa-3x mb-3" style="color: #d1d5db;"></i>
                                    <h5>No documents found</h5>
                                    <p class="text-muted">Try adjusting your filters or search criteria.</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Pagination -->
                        @if($documents->hasPages())
                            <div class="pagination-modern">
                                {{ $documents->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    @if($showDeleteModal)
        <div class="modal fade show" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border-radius: var(--border-radius); border: none; box-shadow: var(--shadow-premium);">
                    <div class="modal-header" style="background: #fee2e2; border-bottom: 1px solid #fecaca;">
                        <h5 class="modal-title" style="color: #dc2626;">
                            <i class="fas fa-exclamation-triangle mr-2"></i>Confirm Deletion
                        </h5>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this document? This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #e5e7eb;">
                        <button type="button" wire:click="cancelDelete" class="btn-modern btn-secondary-modern">
                            Cancel
                        </button>
                        <button type="button" wire:click="deleteDocument" class="btn-modern" style="background: #dc2626; color: white;">
                            <i class="fas fa-trash mr-1"></i>Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- JavaScript for Enhanced UX -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toast notifications
            window.addEventListener('document-deleted', event => {
                // You can integrate with your existing toast system here
                console.log(event.detail.message);
            });

            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && document.querySelector('.modal.show')) {
                    @this.call('cancelDelete');
                }
            });
        });
    </script>
</div>
