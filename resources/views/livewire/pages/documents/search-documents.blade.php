<div>
    <!-- Custom Styles -->
    <style>
        :root {
            --primary-blue: #1e40af;
            --emerald-accent: #10b981;
            --amber-accent: #f59e0b;
            --modern-gray: #6b7280;
            --light-gray: #f8fafc;
            --border-radius: 16px;
            --shadow-elegant: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-premium: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-success: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .search-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }

        .hero-section {
            text-align: center;
            color: white;
            margin-bottom: 3rem;
            padding: 2rem 0;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .hero-subtitle {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .search-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-premium);
            border: none;
            overflow: hidden;
            backdrop-filter: blur(10px);
            margin-bottom: 2rem;
        }

        .search-card-header {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            padding: 2rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .search-card-body {
            padding: 2.5rem;
        }

        .search-module {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-elegant);
            border: 1px solid #e2e8f0;
            transition: var(--transition-smooth);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .search-module:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-premium);
        }

        .module-header {
            padding: 1.5rem;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .module-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .module-icon.admin { background: var(--gradient-primary); }
        .module-icon.subject { background: var(--gradient-secondary); }
        .module-icon.keywords { background: var(--gradient-success); }
        .module-icon.date { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }
        .module-icon.number { background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); }
        .module-icon.control { background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%); }

        .module-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1f2937;
            margin: 0;
        }

        .module-description {
            font-size: 0.875rem;
            color: #6b7280;
            margin: 0;
        }

        .module-body {
            padding: 1.5rem;
        }

        .form-group-premium {
            margin-bottom: 1.5rem;
        }

        .form-label-premium {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.75rem;
            display: block;
            font-size: 0.875rem;
        }

        .form-control-premium {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 1rem 1.25rem;
            font-size: 1rem;
            transition: var(--transition-smooth);
            background: #ffffff;
            width: 100%;
        }

        .form-control-premium:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 4px rgba(30, 64, 175, 0.1);
            outline: none;
            transform: translateY(-1px);
        }

        .form-control-premium::placeholder {
            color: #9ca3af;
        }

        .btn-premium {
            padding: 1rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            transition: var(--transition-smooth);
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }

        .btn-primary-premium {
            background: var(--gradient-primary);
            color: white;
        }

        .btn-primary-premium:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-elegant);
        }

        .btn-secondary-premium {
            background: #f8fafc;
            color: #374151;
            border: 2px solid #e5e7eb;
        }

        .btn-secondary-premium:hover {
            background: #f1f5f9;
            transform: translateY(-1px);
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }

        .results-preview {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-elegant);
            border: 1px solid #e2e8f0;
            margin-top: 2rem;
        }

        .results-header {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: between;
        }

        .results-body {
            padding: 1.5rem;
        }

        .document-item {
            padding: 1.5rem;
            border-bottom: 1px solid #f1f5f9;
            transition: var(--transition-smooth);
        }

        .document-item:hover {
            background: #f8fafc;
        }

        .document-item:last-child {
            border-bottom: none;
        }

        .document-title {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.5rem;
            font-size: 1.125rem;
        }

        .document-meta {
            display: flex;
            gap: 1rem;
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }

        .document-type {
            background: #dbeafe;
            color: #1e40af;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .loading-state {
            text-align: center;
            padding: 3rem;
            color: #6b7280;
        }

        .spinner-premium {
            width: 3rem;
            height: 3rem;
            border: 4px solid #e5e7eb;
            border-top: 4px solid var(--primary-blue);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6b7280;
        }

        .empty-icon {
            font-size: 4rem;
            color: #d1d5db;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .search-card-body {
                padding: 1.5rem;
            }
            
            .module-body {
                padding: 1rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
        }
    </style>

    <!-- Hero Section -->
    <div class="search-container">
        <div class="container-fluid">
            <div class="hero-section">
                <h1 class="hero-title">
                    <i class="fas fa-search mr-3"></i>
                    Search Documents
                </h1>
                <p class="hero-subtitle">
                    Find documents quickly and efficiently using our advanced search system
                </p>
            </div>

            <!-- Main Search Interface -->
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <div class="search-card">
                        <div class="search-card-header">
                            <h2 class="text-center mb-0" style="color: #1f2937; font-weight: 600;">
                                <i class="fas fa-filter mr-2" style="color: var(--primary-blue);"></i>
                                Advanced Document Search
                            </h2>
                        </div>
                        <div class="search-card-body">
                            <div class="row">
                                <!-- Admin Issuance Type -->
                                <div class="col-lg-6 col-md-12">
                                    <div class="search-module">
                                        <div class="module-header">
                                            <div class="module-icon admin">
                                                <i class="fas fa-user-shield"></i>
                                            </div>
                                            <div>
                                                <h3 class="module-title">Admin Issuance Type</h3>
                                                <p class="module-description">Filter by document type and category</p>
                                            </div>
                                        </div>
                                        <div class="module-body">
                                            <div class="form-group-premium">
                                                <label class="form-label-premium">Document Type</label>
                                                <select wire:model="documentTypeFilter" class="form-control-premium">
                                                    <option value="">All Types</option>
                                                    @foreach($documentSubTypes as $subType)
                                                        <option value="{{ $subType->id }}">{{ $subType->document_sub_type_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Subject Search -->
                                <div class="col-lg-6 col-md-12">
                                    <div class="search-module">
                                        <div class="module-header">
                                            <div class="module-icon subject">
                                                <i class="fas fa-file-alt"></i>
                                            </div>
                                            <div>
                                                <h3 class="module-title">Subject</h3>
                                                <p class="module-description">Search by document subject or title</p>
                                            </div>
                                        </div>
                                        <div class="module-body">
                                            <div class="form-group-premium">
                                                <label class="form-label-premium">Document Subject</label>
                                                <textarea wire:model.debounce.500ms="subjectSearch" 
                                                          class="form-control-premium" 
                                                          rows="3"
                                                          placeholder="Enter document subject or title..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Keywords -->
                                <div class="col-lg-6 col-md-12">
                                    <div class="search-module">
                                        <div class="module-header">
                                            <div class="module-icon keywords">
                                                <i class="fas fa-tags"></i>
                                            </div>
                                            <div>
                                                <h3 class="module-title">Keywords</h3>
                                                <p class="module-description">Search using specific keywords</p>
                                            </div>
                                        </div>
                                        <div class="module-body">
                                            <div class="form-group-premium">
                                                <label class="form-label-premium">Keywords</label>
                                                <input type="text" wire:model.debounce.500ms="keywords" 
                                                       class="form-control-premium" 
                                                       placeholder="Enter keywords separated by commas...">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Date Range -->
                                <div class="col-lg-6 col-md-12">
                                    <div class="search-module">
                                        <div class="module-header">
                                            <div class="module-icon date">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                            <div>
                                                <h3 class="module-title">Date</h3>
                                                <p class="module-description">Filter by date range</p>
                                            </div>
                                        </div>
                                        <div class="module-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group-premium">
                                                        <label class="form-label-premium">From Date</label>
                                                        <input type="date" wire:model="dateFrom" class="form-control-premium">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group-premium">
                                                        <label class="form-label-premium">To Date</label>
                                                        <input type="date" wire:model="dateTo" class="form-control-premium">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Issuance Number -->
                                <div class="col-lg-6 col-md-12">
                                    <div class="search-module">
                                        <div class="module-header">
                                            <div class="module-icon number">
                                                <i class="fas fa-hashtag"></i>
                                            </div>
                                            <div>
                                                <h3 class="module-title">Issuance Number</h3>
                                                <p class="module-description">Search by specific issuance number</p>
                                            </div>
                                        </div>
                                        <div class="module-body">
                                            <div class="form-group-premium">
                                                <label class="form-label-premium">Issuance Number</label>
                                                <input type="text" wire:model.debounce.500ms="issuanceNumber" 
                                                       class="form-control-premium" 
                                                       placeholder="Enter issuance number...">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Document Control Number -->
                                <div class="col-lg-6 col-md-12">
                                    <div class="search-module">
                                        <div class="module-header">
                                            <div class="module-icon control">
                                                <i class="fas fa-barcode"></i>
                                            </div>
                                            <div>
                                                <h3 class="module-title">Document Control Number</h3>
                                                <p class="module-description">Search by control number</p>
                                            </div>
                                        </div>
                                        <div class="module-body">
                                            <div class="form-group-premium">
                                                <label class="form-label-premium">Control Number</label>
                                                <input type="text" wire:model.debounce.500ms="controlNumber" 
                                                       class="form-control-premium" 
                                                       placeholder="Enter document control number...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="action-buttons">
                                <button type="button" wire:click="clearFilters" class="btn-premium btn-secondary-premium">
                                    <i class="fas fa-times"></i>
                                    Clear All Filters
                                </button>
                                <button type="button" wire:click="searchDocuments" class="btn-premium btn-primary-premium">
                                    <i class="fas fa-search"></i>
                                    Search Documents
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Search Results -->
                    @if($showResults)
                        <div class="results-preview">
                            <div class="results-header">
                                <h3 style="margin: 0; color: #1f2937; font-weight: 600;">
                                    <i class="fas fa-list-alt mr-2" style="color: var(--primary-blue);"></i>
                                    Search Results
                                </h3>
                                <span class="badge" style="background: var(--primary-blue); color: white; padding: 0.5rem 1rem; border-radius: 8px;">
                                    {{ $totalResults }} {{ Str::plural('result', $totalResults) }}
                                </span>
                            </div>
                            <div class="results-body">
                                @if($loading)
                                    <div class="loading-state">
                                        <div class="spinner-premium"></div>
                                        <h4>Searching documents...</h4>
                                        <p>Please wait while we find the best matches for your criteria.</p>
                                    </div>
                                @elseif($documents && $documents->count() > 0)
                                    @foreach($documents as $document)
                                        <div class="document-item">
                                            <div class="document-title">{{ $document->document_title }}</div>
                                            <div class="document-meta">
                                                <span><i class="fas fa-hashtag mr-1"></i>{{ $document->document_reference_code }}</span>
                                                <span><i class="fas fa-calendar mr-1"></i>{{ $document->created_at->format('M d, Y') }}</span>
                                                <span><i class="fas fa-building mr-1"></i>{{ $document->office->office_name ?? 'N/A' }}</span>
                                            </div>
                                            @if($document->documentSubType)
                                                <div class="document-type">{{ $document->documentSubType->document_sub_type_name }}</div>
                                            @endif
                                        </div>
                                    @endforeach

                                    <!-- Pagination -->
                                    @if($documents->hasPages())
                                        <div class="d-flex justify-content-center mt-4">
                                            {{ $documents->links() }}
                                        </div>
                                    @endif
                                @else
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-search"></i>
                                        </div>
                                        <h4>No documents found</h4>
                                        <p>Try adjusting your search criteria or filters to find more results.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>