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

        /* Upload Document Button Styles */
        .upload-document-btn {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border: 2px solid #0ea5e9;
            border-radius: var(--border-radius);
            padding: 1rem;
            cursor: pointer;
            transition: var(--transition-smooth);
            display: flex;
            align-items: center;
            gap: 1rem;
            text-align: left;
        }

        .upload-document-btn:hover {
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            border-color: #0284c7;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.15);
        }

        .upload-btn-icon {
            font-size: 1.5rem;
            color: #0ea5e9;
            flex-shrink: 0;
        }

        .upload-btn-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .upload-btn-title {
            font-weight: 600;
            color: #0f172a;
            font-size: 0.875rem;
            margin: 0;
        }

        .upload-btn-subtitle {
            color: #64748b;
            font-size: 0.75rem;
            margin: 0;
        }

        .upload-btn-arrow {
            font-size: 0.875rem;
            color: #0ea5e9;
            flex-shrink: 0;
        }

        /* Upload Modal Styles */
        .upload-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1050;
        }

        .upload-modal-content {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-premium);
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .upload-modal-header {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            color: white;
            padding: 1.5rem;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .upload-modal-title {
            font-weight: 600;
            font-size: 1.125rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .upload-modal-close {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0;
            width: 2rem;
            height: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: var(--transition-smooth);
        }

        .upload-modal-close:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .upload-modal-body {
            padding: 2rem;
        }

        .upload-section {
            margin-bottom: 2rem;
        }

        .upload-section-title {
            font-weight: 600;
            color: #374151;
            margin-bottom: 1rem;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .file-upload-zone {
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            background: #f9fafb;
            transition: var(--transition-smooth);
            cursor: pointer;
        }

        .file-upload-zone:hover {
            border-color: #0ea5e9;
            background: #f0f9ff;
        }

        .file-upload-zone.dragover {
            border-color: #0ea5e9;
            background: #e0f2fe;
        }

        .file-upload-icon {
            font-size: 3rem;
            color: #9ca3af;
            margin-bottom: 1rem;
        }

        .file-upload-text {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .file-upload-hint {
            color: #6b7280;
            font-size: 0.875rem;
        }

        .uploaded-files {
            margin-top: 1rem;
        }

        .uploaded-file {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            background: #f3f4f6;
            border-radius: 6px;
            margin-bottom: 0.5rem;
        }

        .file-icon {
            color: #0ea5e9;
            font-size: 1.25rem;
        }

        .file-info {
            flex: 1;
        }

        .file-name {
            font-weight: 500;
            color: #374151;
            font-size: 0.875rem;
        }

        .file-size {
            color: #6b7280;
            font-size: 0.75rem;
        }

        .file-remove {
            background: #fee2e2;
            color: #dc2626;
            border: none;
            border-radius: 4px;
            padding: 0.25rem 0.5rem;
            cursor: pointer;
            font-size: 0.75rem;
            transition: var(--transition-smooth);
        }

        .file-remove:hover {
            background: #fecaca;
        }

        /* Form Elements for Upload Modal */
        .form-group-modern {
            margin-bottom: 1rem;
        }

        .form-label-modern {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .form-control-modern {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.875rem;
            transition: var(--transition-smooth);
            background: white;
        }

        .form-control-modern:focus {
            outline: none;
            border-color: #0ea5e9;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        }

        .btn-modern {
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
            transition: var(--transition-smooth);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary-modern {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            color: white;
        }

        .btn-primary-modern:hover {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        }

        .btn-secondary-modern {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .btn-secondary-modern:hover {
            background: #e5e7eb;
            border-color: #9ca3af;
        }

        /* PDF Preview Styles */
        .pdf-preview-container {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 1rem;
            height: 100%;
        }

        .preview-title {
            font-weight: 600;
            color: #374151;
            margin-bottom: 1rem;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pdf-preview {
            display: flex;
            flex-direction: column;
            height: 300px;
        }

        .pdf-viewer {
            flex: 1;
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background: white;
        }

        .preview-actions {
            margin-top: 0.75rem;
            display: flex;
            justify-content: center;
        }

        .file-preview-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 300px;
            text-align: center;
            color: #6b7280;
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 6px;
        }

        .file-preview-placeholder i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #9ca3af;
        }

        .file-preview-placeholder p {
            margin: 0.5rem 0;
            font-weight: 500;
        }

        .file-preview-placeholder small {
            color: #9ca3af;
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

            .upload-zone {
                padding: 1rem 0.75rem;
            }

            .upload-icon {
                font-size: 1.25rem;
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
                                    <textarea wire:model="subjectSearch" 
                                              class="form-control-modern" 
                                              style="padding: 0.375rem 0.75rem; font-size: 0.875rem; min-height: 60px; resize: vertical;"
                                              rows="2"
                                              placeholder="Enter document subject..."></textarea>
                                </div>
                                <div class="form-group-modern mb-0">
                                    <label class="form-label-modern mb-1" style="font-size: 0.875rem;">Issuance Number</label>
                                    <input type="text" wire:model="issuanceNumber" 
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
                                            <input type="date" wire:model="dateFrom" class="form-control-modern" style="padding: 0.375rem 0.75rem; font-size: 0.875rem; color: #000000;">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-0">
                                        <div class="form-group-modern mb-0">
                                            <label class="form-label-modern mb-1" style="font-size: 0.875rem;">To Date</label>
                                            <input type="date" wire:model="dateTo" class="form-control-modern" style="padding: 0.375rem 0.75rem; font-size: 0.875rem; color: #000000;">
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

                            <!-- Upload Document Button -->
                            <div class="mt-3">
                                <button type="button" wire:click="openUploadModal" class="upload-document-btn w-100">
                                    <i class="fas fa-cloud-upload-alt upload-btn-icon"></i>
                                    <div class="upload-btn-content">
                                        <span class="upload-btn-title">Upload Document</span>
                                        <small class="upload-btn-subtitle">Add new issuance document</small>
                                    </div>
                                    <i class="fas fa-chevron-right upload-btn-arrow"></i>
                                </button>
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

    <!-- Upload Document Modal -->
    @if($showUploadModal)
        <div class="upload-modal">
            <div class="upload-modal-content">
                <div class="upload-modal-header">
                    <h3 class="upload-modal-title">
                        <i class="fas fa-cloud-upload-alt"></i>
                        Upload Document
                    </h3>
                    <button wire:click="closeUploadModal" class="upload-modal-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="upload-modal-body">
                    <!-- Document Information Section -->
                    <div class="upload-section">
                        <h4 class="upload-section-title">
                            <i class="fas fa-info-circle"></i>
                            Document Information
                        </h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label class="form-label-modern">Document Title *</label>
                                    <input type="text" wire:model="uploadForm.title" class="form-control-modern" placeholder="Enter document title">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label class="form-label-modern">Issuance Number *</label>
                                    <input type="text" wire:model="uploadForm.issuance_number" class="form-control-modern" placeholder="Enter issuance number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label class="form-label-modern">Document Type *</label>
                                    <select wire:model="uploadForm.document_sub_type_id" class="form-control-modern">
                                        <option value="">Select document type</option>
                                        @foreach($documentSubTypes as $subType)
                                            @if($subType->documentType)
                                                <option value="{{ $subType->id }}">{{ $subType->documentType->document_type_name }} - {{ $subType->document_sub_type_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label class="form-label-modern">Document Date *</label>
                                    <input type="date" wire:model="uploadForm.document_date" class="form-control-modern">
                                </div>
                            </div>
                        </div>
                        <div class="form-group-modern">
                            <label class="form-label-modern">Description</label>
                            <textarea wire:model="uploadForm.description" rows="3" class="form-control-modern" placeholder="Enter document description"></textarea>
                        </div>
                    </div>

                    <!-- File Upload Section -->
                     <div class="upload-section">
                         <h4 class="upload-section-title">
                             <i class="fas fa-file-upload"></i>
                             File Upload
                         </h4>
                         
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="file-upload-zone" onclick="document.getElementById('fileInput').click()">
                                     <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                                     <div class="file-upload-text">Click to upload or drag and drop</div>
                                     <div class="file-upload-hint">PDF, DOC, DOCX files up to 10MB</div>
                                     <input type="file" id="fileInput" wire:model="uploadForm.file" accept=".pdf,.doc,.docx" style="display: none;">
                                 </div>
                                 
                                 @if($uploadForm['file'] ?? false)
                                     <div class="uploaded-files">
                                         <div class="uploaded-file">
                                             <i class="fas fa-file-alt file-icon"></i>
                                             <div class="file-info">
                                                 <div class="file-name">{{ $uploadForm['file']->getClientOriginalName() }}</div>
                                                 <div class="file-size">{{ number_format($uploadForm['file']->getSize() / 1024, 2) }} KB</div>
                                             </div>
                                             <button wire:click="removeFile" class="file-remove">
                                                 <i class="fas fa-times"></i>
                                             </button>
                                         </div>
                                     </div>
                                 @endif
                             </div>
                             
                             @if($uploadForm['file'] ?? false)
                                 <div class="col-md-6">
                                     <div class="pdf-preview-container">
                                         <h5 class="preview-title">
                                             <i class="fas fa-eye"></i>
                                             Document Preview
                                         </h5>
                                         @if(strtolower(pathinfo($uploadForm['file']->getClientOriginalName(), PATHINFO_EXTENSION)) === 'pdf')
                                             <div class="pdf-preview">
                                                 <iframe 
                                                     src="{{ $uploadForm['file']->temporaryUrl() }}" 
                                                     class="pdf-viewer"
                                                     frameborder="0">
                                                 </iframe>
                                                 <div class="preview-actions">
                                                     <button type="button" onclick="window.open('{{ $uploadForm['file']->temporaryUrl() }}', '_blank')" class="btn-modern btn-secondary-modern">
                                                         <i class="fas fa-external-link-alt"></i>
                                                         Open in New Tab
                                                     </button>
                                                 </div>
                                             </div>
                                         @else
                                             <div class="file-preview-placeholder">
                                                 <i class="fas fa-file-alt"></i>
                                                 <p>Preview not available for this file type</p>
                                                 <small>Only PDF files can be previewed</small>
                                             </div>
                                         @endif
                                     </div>
                                 </div>
                             @endif
                         </div>
                     </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end" style="gap: 0.75rem; padding-top: 1rem; border-top: 1px solid #e5e7eb;">
                        <button wire:click="closeUploadModal" class="btn-modern btn-secondary-modern">
                            Cancel
                        </button>
                        <button wire:click="uploadDocument" class="btn-modern btn-primary-modern">
                            <i class="fas fa-upload mr-2"></i>
                            Upload Document
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

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
