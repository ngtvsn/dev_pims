<div>
    <!-- Custom Styles -->
    <style>
        :root {
            --primary-green: #348547;
            --secondary-green: #537b60;
            --light-green: #f0f7f2;
            --emerald-accent: #10b981;
            --amber-accent: #f59e0b;
            --modern-gray: #6b7280;
            --border-radius: 12px;
            --shadow-elegant: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-premium: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .issuance-container {
            background: linear-gradient(135deg, var(--light-green) 0%, #e8f5ea 100%);
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
            background: linear-gradient(90deg, var(--primary-green), var(--emerald-accent));
        }

        .card-header-modern {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--secondary-green) 100%);
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
            border-left: 4px solid var(--primary-green);
            transition: var(--transition-smooth);
        }

        .filter-section:hover {
            background: #f1f5f9;
            border-left-color: var(--emerald-accent);
            transform: translateX(2px);
        }

        .filter-section-title {
            font-weight: 600;
            color: var(--primary-green);
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
            width: 100%;
            box-sizing: border-box;
        }

        .form-control-modern:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(52, 133, 71, 0.1);
            outline: none;
            transform: translateY(-1px);
        }

        .form-control-modern:hover {
            border-color: #cbd5e1;
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
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--secondary-green) 100%);
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
            padding: 0.125rem 0.5rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: capitalize;
            letter-spacing: 0.025em;
            display: inline-flex;
            align-items: center;
            border: 1px solid transparent;
        }

        /* Document Type Specific Badge Colors */
        .badge-modern.pitahc-order {
            background: #dbeafe;
            color: var(--primary-green);
            border: 1px solid #bfdbfe;
        }

        .badge-modern.pitahc-advisory {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .badge-modern.pitahc-memorandum {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
        }

        .badge-modern.general {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .badge-primary { background: var(--light-green); color: var(--primary-green); }
        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-secondary { background: #f3f4f6; color: #374151; }

        .action-btn {
            padding: 0.375rem;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
            cursor: pointer;
            transition: all 0.2s ease;
            margin: 0 0.125rem;
            background: white;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
        }

        .action-btn-edit {
            color: var(--secondary-green);
        }

        .action-btn-delete {
            color: #ef4444;
        }

        .action-btn:hover {
            border-color: #d1d5db;
            background: #f9fafb;
        }

        .action-btn-edit:hover {
            color: #1d4ed8;
            border-color: #bfdbfe;
            background: #eff6ff;
        }

        .action-btn-delete:hover {
            color: #dc2626;
            border-color: #fecaca;
            background: #fef2f2;
        }

        /* Enhanced Search Input Styles */
        .search-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            font-size: 0.875rem;
            z-index: 2;
            pointer-events: none;
        }

        .search-input {
            padding-left: 2.5rem !important;
        }

        .clear-search-btn {
            position: absolute;
            right: 0.5rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 50%;
            width: 1.5rem;
            height: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            z-index: 2;
        }

        .clear-search-btn:hover {
            background-color: #f3f4f6;
            color: #374151;
        }

        .clear-search-btn:active {
            transform: translateY(-50%) scale(0.95);
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
            border-top: 3px solid var(--primary-green);
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
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
            padding: 1rem 0;
        }

        @media (max-width: 1200px) {
            .document-cards-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
        }

        @media (max-width: 768px) {
            .document-cards-container {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }
        }

        .document-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            transition: all 0.2s ease;
            overflow: hidden;
            position: relative;
        }

        .document-card:hover {
            border-color: var(--primary-green);
            box-shadow: 0 8px 25px -5px rgba(52, 133, 71, 0.15), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transform: translateY(-2px);
        }

        /* Document Type Color Coding */
        .document-card[data-type="PITAHC ORDER"]::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, var(--primary-green), #1d5c2d);
        }

        .document-card[data-type="PITAHC ADVISORY"]::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, #10b981, #059669);
        }

        .document-card[data-type="PITAHC MEMORANDUM"]::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, #f59e0b, #d97706);
        }

        .document-card.compact {
            min-height: auto;
        }

        .document-card.expanded {
            min-height: auto;
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
            color: #6b7280;
            font-size: 0.75rem;
            background: #f9fafb;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            border: 1px solid #e5e7eb;
            word-wrap: break-word;
            overflow-wrap: break-word;
            max-width: 180px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            letter-spacing: 0.025em;
            text-transform: uppercase;
        }

        .document-card.compact .document-number {
            font-size: 1rem;
            font-weight: 700;
            padding: 0.375rem 0.625rem;
            max-width: 200px;
            letter-spacing: 0.3px;
        }

        .document-number:hover {
            background: #f0f9ff;
            border-color: var(--primary-blue);
            transform: scale(1.02);
            transition: all 0.2s ease;
        }

        .document-actions {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            padding: 0.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition-smooth);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            font-size: 0.875rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .action-btn-edit {
            background: linear-gradient(135deg, var(--primary-green), #1d5c2d);
            color: white;
        }

        .action-btn-edit:hover {
            background: linear-gradient(135deg, #1d5c2d, #15803d);
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 6px 20px rgba(52, 133, 71, 0.3);
        }

        .action-btn-delete {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .action-btn-delete:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.3);
        }

        .document-card-body {
            padding: 1.25rem;
        }

        .document-card-body.compact {
            padding: 1rem;
        }

        .document-title {
            font-weight: 500;
            color: #111827;
            margin-bottom: 0.5rem;
            line-height: 1.4;
            font-size: 0.95rem;
            word-wrap: break-word;
            overflow-wrap: break-word;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: all 0.2s ease;
        }

        .document-card:hover .document-title {
            color: var(--primary-green);
            transform: translateX(2px);
        }

        .document-title-link {
            text-decoration: none;
            color: inherit;
            cursor: pointer;
        }

        .document-title-link:hover {
            text-decoration: none;
            color: var(--primary-green);
        }

        .document-card.compact .document-title {
            font-size: 0.8rem;
            margin-bottom: 0.375rem;
            -webkit-line-clamp: 1;
        }



        .document-meta {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }



        .meta-item {
            display: flex;
            align-items: flex-start;
            gap: 0.375rem;
            margin-bottom: 0.25rem;
            padding: 0.25rem 0;
            border-radius: 4px;
            transition: var(--transition-smooth);
        }

        .document-card.compact .meta-item {
            gap: 0.25rem;
            margin-bottom: 0.125rem;
            padding: 0.125rem 0;
        }

        .meta-item:hover {
            background: rgba(52, 133, 71, 0.05);
            transform: translateX(2px);
        }

        .document-card:hover .meta-item {
            transition: all 0.2s ease;
        }

        .meta-label {
            font-weight: 500;
            color: var(--modern-gray);
            font-size: 0.75rem;
            min-width: 60px;
            flex-shrink: 0;
        }

        .document-card.compact .meta-label {
            font-size: 0.7rem;
            min-width: 50px;
        }

        .meta-value {
            color: #6b7280;
            font-size: 0.75rem;
            word-wrap: break-word;
            overflow-wrap: break-word;
            line-height: 1.3;
            transition: color 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .document-card.compact .meta-value {
            font-size: 0.7rem;
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
            opacity: 0;
            animation: modalFadeIn 0.3s ease-out forwards;
        }

        .upload-modal-content {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-premium);
            width: 95%;
            max-width: 1400px;
            max-height: 95vh;
            overflow-y: auto;
            transform: scale(0.9) translateY(-20px);
            animation: modalSlideIn 0.3s ease-out forwards;
        }

        /* Modal Animation Keyframes */
        @keyframes modalFadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes modalSlideIn {
            from {
                transform: scale(0.9) translateY(-20px);
                opacity: 0;
            }
            to {
                transform: scale(1) translateY(0);
                opacity: 1;
            }
        }

        @keyframes modalFadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }

        @keyframes modalSlideOut {
            from {
                transform: scale(1) translateY(0);
                opacity: 1;
            }
            to {
                transform: scale(0.9) translateY(-20px);
                opacity: 0;
            }
        }

        /* Modal closing animation */
        .upload-modal.closing {
            animation: modalFadeOut 0.25s ease-in forwards;
        }

        .upload-modal.closing .upload-modal-content {
            animation: modalSlideOut 0.25s ease-in forwards;
        }

        /* Edit and Delete Modal Animations */
        .edit-modal, .delete-modal {
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
            opacity: 0;
            animation: modalFadeIn 0.3s ease-out forwards;
        }

        .edit-modal .modal-content, .delete-modal .modal-content {
            transform: scale(0.9) translateY(-20px);
            animation: modalSlideIn 0.3s ease-out forwards;
        }

        .edit-modal.closing, .delete-modal.closing {
            animation: modalFadeOut 0.25s ease-in forwards;
        }

        .edit-modal.closing .modal-content, .delete-modal.closing .modal-content {
            animation: modalSlideOut 0.25s ease-in forwards;
        }

        /* Form sections animation for edit modal */
        .edit-form-section {
            opacity: 0;
            transform: translateY(10px);
            animation: sectionFadeIn 0.4s ease-out forwards;
        }

        .edit-form-section:nth-child(1) {
            animation-delay: 0.1s;
        }

        .edit-form-section:nth-child(2) {
            animation-delay: 0.2s;
        }

        .edit-modal-actions {
            opacity: 0;
            transform: translateY(10px);
            animation: sectionFadeIn 0.4s ease-out 0.3s forwards;
        }

        /* Delete modal content animation */
        .delete-modal-content {
            opacity: 0;
            transform: translateY(10px);
            animation: sectionFadeIn 0.4s ease-out 0.1s forwards;
        }

        .delete-modal-actions {
            opacity: 0;
            transform: translateY(10px);
            animation: sectionFadeIn 0.4s ease-out 0.2s forwards;
        }

        /* Infinite Scroll Styles */
        .load-more-container {
            border-top: 1px solid rgba(0,0,0,0.1);
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .load-more-btn {
            border: 2px solid var(--primary-green);
            color: var(--primary-green);
            background: white;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(52, 133, 71, 0.1);
        }

        .load-more-btn:hover {
            background: var(--primary-green);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(52, 133, 71, 0.2);
        }

        .load-more-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .end-of-results {
            font-style: italic;
            border-top: 1px solid rgba(0,0,0,0.1);
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .loading-indicator {
            background: rgba(255,255,255,0.9);
            border-radius: 10px;
            margin: 1rem;
        }

        .spinner-border.text-success {
            color: var(--primary-green) !important;
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
            opacity: 0;
            transform: translateY(10px);
            animation: sectionFadeIn 0.4s ease-out 0.1s forwards;
        }

        .upload-section:nth-child(2) {
            animation-delay: 0.2s;
        }

        .upload-section:nth-child(3) {
            animation-delay: 0.3s;
        }

        @keyframes sectionFadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .upload-modal-actions {
            opacity: 0;
            transform: translateY(10px);
            animation: sectionFadeIn 0.4s ease-out 0.4s forwards;
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
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 0.25rem 0.5rem;
            cursor: pointer;
            font-size: 0.75rem;
            transition: var(--transition-smooth);
        }

        .file-remove:hover {
            background: #dc2626;
        }

        .preview-button-container {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
        }

        .preview-button-container .btn-modern {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .preview-button-container .btn-secondary-modern {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .preview-button-container .btn-secondary-modern:hover {
            background: #e5e7eb;
            border-color: #9ca3af;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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

        /* Enhanced Modal Layout */
        .upload-modal-main-row {
            min-height: 600px;
        }

        .upload-form-column {
            padding-right: 1.5rem;
            border-right: 1px solid #e5e7eb;
        }

        .upload-preview-column {
            padding-left: 1.5rem;
        }

        /* File Tabs Styles */
        .file-tabs {
            margin-bottom: 0;
        }

        .file-tabs .nav-tabs {
            border-bottom: 2px solid #e5e7eb;
            margin-bottom: 0;
        }

        .file-tabs .nav-link {
            border: none;
            border-radius: 8px 8px 0 0;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #6b7280;
            background: transparent;
            transition: all 0.2s ease;
            border-bottom: 3px solid transparent;
            margin-right: 0.25rem;
        }

        .file-tabs .nav-link:hover {
            color: #374151;
            background: #f9fafb;
            border-bottom-color: #d1d5db;
        }

        .file-tabs .nav-link.active {
            color: #3b82f6;
            background: #f8fafc;
            border-bottom-color: #3b82f6;
        }

        .file-tabs .nav-link i {
            margin-right: 0.5rem;
        }

        /* Modern Preview Container */
        .preview-container {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 0 0 12px 12px;
            min-height: 600px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .preview-container.no-tabs {
            border-radius: 12px;
        }

        .preview-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #e5e7eb;
            background: #f8fafc;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .preview-title {
            font-weight: 600;
            font-size: 1rem;
            margin: 0;
            color: #374151;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .preview-title i {
            color: #3b82f6;
        }

        .preview-controls {
            display: flex;
            gap: 0.5rem;
        }

        .preview-controls .btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 6px;
        }

        .preview-content {
            flex: 1;
            padding: 1rem;
            display: flex;
            flex-direction: column;
        }

        .pdf-viewer {
            flex: 1;
            width: 100%;
            min-height: 500px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: white;
        }

        /* Placeholder Styles */
        .preview-placeholder {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #6b7280;
            padding: 3rem 2rem;
        }

        .preview-placeholder i {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            color: #9ca3af;
        }

        .preview-placeholder h4 {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.75rem;
            font-size: 1.125rem;
        }

        .preview-placeholder p {
            margin-bottom: 0;
            color: #6b7280;
            font-size: 0.875rem;
        }

        .upload-placeholder {
            background: #f9fafb;
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            min-height: 600px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #6b7280;
            padding: 3rem 2rem;
            transition: all 0.3s ease;
        }

        .upload-placeholder:hover {
            border-color: #9ca3af;
            background: #f3f4f6;
        }

        .upload-placeholder i {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            color: #9ca3af;
        }

        .upload-placeholder h4 {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.75rem;
            font-size: 1.125rem;
        }

        .upload-placeholder p {
            margin-bottom: 0;
            color: #6b7280;
            font-size: 0.875rem;
        }

        /* Button Styles */
        .btn-outline-modern {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            transition: all 0.2s ease;
        }

        .btn-outline-modern:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }

        .btn-info-modern {
            background: linear-gradient(135deg, var(--primary-green) 0%, #1d5c2d 100%);
            color: white;
            border: none;
            transition: all 0.2s ease;
        }

        .btn-info-modern:hover {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--secondary-green) 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(52, 133, 71, 0.4);
        }

        .btn-outline-primary-modern {
            background: transparent;
            border: 2px solid var(--primary-green);
                color: var(--primary-green);
            transition: all 0.2s ease;
        }

        .btn-outline-primary-modern:hover {
            background: var(--primary-green);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .upload-form-column {
                padding-right: 1rem;
                border-right: none;
                border-bottom: 1px solid #e5e7eb;
                padding-bottom: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .upload-preview-column {
                padding-left: 1rem;
            }

            .upload-modal-content {
                width: 95%;
                max-width: none;
            }

            .pdf-preview-container-large {
                min-height: 400px;
            }

            .upload-placeholder-large {
                min-height: 400px;
            }
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
            padding: 0.75rem;
        }

        .document-card-body.compact {
            padding: 0.5rem 0.75rem;
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
                    <h1 class="m-0 text-dark" style="font-weight: 700; color: var(--primary-green) !important;">
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
                                    <div class="search-input-wrapper">
                                        <i class="fas fa-search search-icon"></i>
                                        <textarea wire:model="subjectSearch" 
                                                  class="form-control-modern search-input" 
                                                  style="padding: 0.375rem 0.75rem 0.375rem 2.5rem; font-size: 0.875rem; min-height: 60px; resize: vertical;"
                                                  rows="2"
                                                  placeholder="Enter document subject..."></textarea>
                                        @if($subjectSearch)
                                            <button wire:click="$set('subjectSearch', '')" class="clear-search-btn" type="button">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group-modern mb-0">
                                    <label class="form-label-modern mb-1" style="font-size: 0.875rem;">Issuance Number</label>
                                    <div class="search-input-wrapper">
                                        <i class="fas fa-hashtag search-icon"></i>
                                        <input type="text" wire:model="issuanceNumber" 
                                               class="form-control-modern search-input" 
                                               style="padding: 0.375rem 0.75rem 0.375rem 2.5rem; font-size: 0.875rem;"
                                               placeholder="Enter issuance number...">
                                        @if($issuanceNumber)
                                            <button wire:click="$set('issuanceNumber', '')" class="clear-search-btn" type="button">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @endif
                                    </div>
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

                        <!-- Loading indicator for infinite scroll -->
                        <div class="loading-indicator" wire:loading.delay wire:target="loadMore" style="display: none; text-align: center; padding: 1rem;">
                            <div class="spinner-border text-success" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <p class="mt-2 text-muted">Loading more documents...</p>
                        </div>

                        <!-- Document Cards Grid -->
                        <div class="document-cards-container">
                            @forelse($documents as $document)
                                <div class="document-card" data-type="{{ $document->documentSubType->document_sub_type_name ?? 'General' }}">
                                    <div class="document-card-header">
                                        <div class="document-number">
                                            {{ $document->document_reference_code ?: 'DOC-' . str_pad($document->id, 4, '0', STR_PAD_LEFT) }}
                                        </div>
                                        <div class="document-actions">
                                            <button wire:click="openEditModal({{ $document->id }})" class="action-btn action-btn-edit" title="Edit Document">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button wire:click="confirmDelete({{ $document->id }})" 
                                                    class="action-btn action-btn-delete" 
                                                    title="Delete Document">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="document-card-body compact">
                                        @if($document->file_path)
                                            <a href="{{ Storage::url($document->file_path) }}" target="_blank" class="document-title-link">
                                                <h6 class="document-title">{{ $document->document_title ?: 'Untitled Document' }}</h6>
                                            </a>
                                        @else
                                            <h6 class="document-title">{{ $document->document_title ?: 'Untitled Document' }}</h6>
                                            <p class="text-muted small"><i class="fas fa-info-circle"></i> No file attached</p>
                                        @endif
                                        
                                        <div class="document-meta">
                                            <div class="meta-item">
                                                <span class="meta-label"><i class="fas fa-tag"></i> Type:</span>
                                                <span class="badge-modern {{ strtolower(str_replace(' ', '-', $document->documentSubType->document_sub_type_name ?? 'general')) }}">
                                                    {{ $document->documentSubType->document_sub_type_name ?? 'General' }}
                                                </span>
                                            </div>
                                            <div class="meta-item">
                                                <span class="meta-label"><i class="fas fa-calendar-alt"></i> Date:</span>
                                                <span class="meta-value">{{ $document->formatted_date }}</span>
                                            </div>
                                        </div>

                                        @if($document->versions->count() > 0)
                                            <div class="document-versions">
                                                <h6 class="versions-title">Versions</h6>
                                                <ul class="versions-list">
                                                    @foreach($document->versions as $version)
                                                        <li>
                                                            @if($version->file_path)
                                                                <a href="{{ Storage::url($version->file_path) }}" target="_blank">{{ $version->document_title }} ({{ $version->formatted_date }})</a>
                                                            @else
                                                                <span class="text-muted">{{ $version->document_title }} ({{ $version->formatted_date }}) - No file</span>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
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

                        <!-- Infinite Scroll Load More -->
                        @if($hasMoreItems)
                            <div class="load-more-container" style="text-align: center; padding: 2rem;">
                                <button wire:click="loadMore" class="btn btn-outline-success btn-lg load-more-btn" 
                                        wire:loading.attr="disabled" wire:target="loadMore">
                                    <span wire:loading.remove wire:target="loadMore">
                                        <i class="fas fa-chevron-down"></i> Load More Documents
                                    </span>
                                    <span wire:loading wire:target="loadMore">
                                        <i class="fas fa-spinner fa-spin"></i> Loading...
                                    </span>
                                </button>
                            </div>
                        @endif
                        
                        <!-- End of results indicator -->
                        @if(!$hasMoreItems && count($documents) > 0)
                            <div class="end-of-results" style="text-align: center; padding: 2rem; color: #6c757d;">
                                <i class="fas fa-check-circle"></i> All documents loaded
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
                    <div class="row upload-modal-main-row">
                        <!-- Left Column: Form Content -->
                        <div class="col-lg-6 upload-form-column">
                            <!-- Document Information Section -->
                            <div class="upload-section">
                                <h4 class="upload-section-title">
                                    <i class="fas fa-info-circle"></i>
                                    Document Information
                                </h4>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group-modern">
                                            <label class="form-label-modern">Document Title *</label>
                                            <textarea wire:model.defer="uploadForm.title" rows="3" class="form-control-modern" placeholder="Enter document title"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group-modern">
                                            <label class="form-label-modern">Issuance Number *</label>
                                            <input type="text" wire:model.defer="uploadForm.issuance_number" class="form-control-modern" placeholder="Enter issuance number">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group-modern">
                                            <label class="form-label-modern">Document Type *</label>
                                            <select wire:model.defer="uploadForm.document_sub_type_id" class="form-control-modern">
                                                <option value="">Select document type</option>
                                                @foreach($documentSubTypes as $subType)
                                                    @if($subType->documentType)
                                                        <option value="{{ $subType->id }}">{{ $subType->documentType->document_type_name }} - {{ $subType->document_sub_type_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group-modern">
                                            <label class="form-label-modern">Document Date *</label>
                                            <input type="date" wire:model.defer="uploadForm.document_date" class="form-control-modern">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- File Upload Section -->
                            <div class="upload-section">
                                <h4 class="upload-section-title">
                                    <i class="fas fa-file-upload"></i>
                                    File Upload * <small class="text-muted">(Multiple files supported)</small>
                                </h4>
                                
                                <div class="file-upload-zone" onclick="document.getElementById('fileInput').click()">
                                    <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                                    <div class="file-upload-text">Click to upload or drag and drop multiple files</div>
                                    <div class="file-upload-hint">PDF, DOC, DOCX files up to 15MB each</div>
                                    <input type="file" id="fileInput" wire:model="uploadForm.files" accept=".pdf,.doc,.docx" multiple style="display: none;">
                                </div>
                                
                                @if(!empty($uploadedFiles))
                                    <div class="uploaded-files">
                                        @foreach($uploadedFiles as $file)
                                            <div class="uploaded-file">
                                                <i class="fas fa-file-alt file-icon"></i>
                                                <div class="file-info">
                                                    <div class="file-name">{{ $file['name'] }}</div>
                                                    <div class="file-size">{{ $file['size'] }}</div>
                                                </div>
                                                <button wire:click="removeFile({{ $file['index'] }})" class="file-remove" style="background: #ef4444;">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                        <div class="mt-2">
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle"></i>
                                                {{ count($uploadedFiles) }} file(s) selected
                                            </small>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Right Column: Preview -->
                        <div class="col-lg-6 upload-preview-column">
                            @if(!empty($uploadedFiles))
                                @php
                                    $selectedIndex = $selectedFileIndex ?? 0;
                                    $selectedFile = isset($uploadForm['files'][$selectedIndex]) ? $uploadForm['files'][$selectedIndex] : null;
                                    $selectedFileInfo = $uploadedFiles[$selectedIndex] ?? null;
                                    $hasMultipleFiles = count($uploadedFiles) > 1;
                                @endphp

                                <!-- File Tabs (if multiple files) -->
                                @if($hasMultipleFiles)
                                    <div class="file-tabs">
                                        <div class="nav nav-tabs">
                                            @foreach($uploadedFiles as $index => $fileInfo)
                                                <button class="nav-link {{ $index === ($selectedFileIndex ?? 0) ? 'active' : '' }}" 
                                                        wire:click="$set('selectedFileIndex', {{ $index }})">
                                                    <i class="fas fa-file-{{ strtolower(pathinfo($fileInfo['name'], PATHINFO_EXTENSION)) === 'pdf' ? 'pdf' : 'alt' }}"></i>
                                                    {{ Str::limit($fileInfo['name'], 15) }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Preview Container -->
                                <div class="preview-container {{ !$hasMultipleFiles ? 'no-tabs' : '' }}">
                                    @if($selectedFile && $selectedFileInfo && strtolower(pathinfo($selectedFileInfo['name'], PATHINFO_EXTENSION)) === 'pdf')
                                        <!-- PDF Preview -->
                                        <div class="preview-header">
                                            <h4 class="preview-title">
                                                <i class="fas fa-file-pdf"></i>
                                                {{ Str::limit($selectedFileInfo['name'], 30) }}
                                            </h4>
                                            <div class="preview-controls">
                                                <button wire:click="togglePreview" class="btn btn-sm btn-outline-secondary">
                                                    <i class="fas fa-{{ $showPreview ? 'eye-slash' : 'eye' }}"></i>
                                                    {{ $showPreview ? 'Hide' : 'Show' }}
                                                </button>
                                            </div>
                                        </div>
                                        @if($showPreview)
                                            <div class="preview-content">
                                                <iframe src="{{ $selectedFile->temporaryUrl() }}" class="pdf-viewer"></iframe>
                                            </div>
                                        @else
                                            <div class="preview-placeholder">
                                                <i class="fas fa-eye-slash"></i>
                                                <h4>Preview Hidden</h4>
                                                <p>Click "Show" to view the PDF preview</p>
                                            </div>
                                        @endif
                                    @else
                                        <!-- Non-PDF File -->
                                        <div class="preview-header">
                                            <h4 class="preview-title">
                                                <i class="fas fa-file-alt"></i>
                                                {{ $selectedFileInfo ? Str::limit($selectedFileInfo['name'], 30) : 'Document' }}
                                            </h4>
                                        </div>
                                        <div class="preview-placeholder">
                                            <i class="fas fa-file-alt"></i>
                                            <h4>Preview Not Available</h4>
                                            <p>{{ $selectedFileInfo ? $selectedFileInfo['name'] : 'No file selected' }}</p>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <!-- Upload Placeholder -->
                                <div class="upload-placeholder">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <h4>Upload Documents</h4>
                                    <p>Select files to see previews here</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end upload-modal-actions" style="gap: 0.75rem; padding-top: 1rem; border-top: 1px solid #e5e7eb;">
                        <button wire:click="closeUploadModal" class="btn-modern btn-secondary-modern">
                            Cancel
                        </button>
                        <button wire:click="uploadDocument" class="btn-modern btn-primary-modern" @if(!empty($uploadedFiles)) @endif>
                            <i class="fas fa-upload mr-2"></i>
                            Post Document
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Edit Document Modal --}}
        @if ($showEditModal)
        <div class="edit-modal" id="editModal">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <form wire:submit.prevent="updateDocument">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Document</h5>
                            <button type="button" onclick="closeEditModal()" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group edit-form-section">
                                        <label for="edit_document_title">Document Title</label>
                                        <textarea id="edit_document_title" wire:model.defer="editForm.title" rows="3" class="form-control" placeholder="Enter document title"></textarea>
                                        @error('editForm.title') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group edit-form-section">
                                        <label for="edit_issuance_number">Issuance Number</label>
                                        <input type="text" id="edit_issuance_number" wire:model.defer="editForm.issuance_number" class="form-control" placeholder="e.g., MC-2023-001">
                                        @error('editForm.issuance_number') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group edit-form-section">
                                        <label for="edit_document_sub_type_id">Document Type</label>
                                        <select id="edit_document_sub_type_id" wire:model.defer="editForm.document_sub_type_id" class="form-control">
                                            <option value="">Select Document Type</option>
                                            @foreach($documentSubTypes as $subType)
                                                <option value="{{ $subType->id }}">{{ $subType->document_sub_type_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('editForm.document_sub_type_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group edit-form-section">
                                        <label for="edit_document_date">Date of Issuance</label>
                                        <input type="date" id="edit_document_date" wire:model.defer="editForm.document_date" class="form-control">
                                        @error('editForm.document_date') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group edit-form-section">
                                        <label>Current File</label>
                                        <div>
                                            @if($editForm['current_file_path'])
                                                <a href="{{ Storage::url($editForm['current_file_path']) }}" target="_blank" class="btn btn-info btn-sm">View Current File</a>
                                                <p class="text-muted small mt-1">{{ basename($editForm['current_file_path']) }}</p>
                                            @else
                                                <p class="text-muted small"><i class="fas fa-info-circle"></i> No file currently attached</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group edit-form-section">
                                        <label for="edit_file">Upload New Version (Optional)</label>
                                                                                <input type="file" id="edit_file" wire:model="editForm.file" class="form-control-file">
                                        @error('editForm.file') <span class="text-danger">{{ $message }}</span> @enderror
                                        <div wire:loading wire:target="editForm.file" class="text-sm text-gray-500">Uploading...</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer edit-modal-actions">
                            <button type="button" onclick="closeEditModal()" class="btn btn-secondary">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
        @if($showDeleteModal)
        <div class="delete-modal" id="deleteModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border-radius: var(--border-radius); border: none; box-shadow: var(--shadow-premium);">
                    <div class="modal-header" style="background: #fee2e2; border-bottom: 1px solid #fecaca;">
                        <h5 class="modal-title" style="color: #dc2626;">
                            <i class="fas fa-exclamation-triangle mr-2"></i>Confirm Deletion
                        </h5>
                    </div>
                    <div class="modal-body delete-modal-content">
                        <p class="mb-3">Are you sure you want to delete this document? Please provide a reason for deletion.</p>
                        
                        <div class="form-group">
                            <label for="deletionReason" class="form-label">
                                Reason for Deletion <span class="text-danger">*</span>
                            </label>
                            <textarea 
                                wire:model.live="deletionReason"
                                id="deletionReason"
                                class="form-control @error('deletionReason') is-invalid @enderror"
                                rows="4"
                                placeholder="Please explain why this document needs to be deleted..."
                                maxlength="500"
                                style="resize: none;"></textarea>
                            @error('deletionReason')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                {{ strlen($deletionReason) }}/500 characters
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer delete-modal-actions" style="border-top: 1px solid #e5e7eb;">
                        <button type="button" onclick="closeDeleteModal()" class="btn-modern btn-secondary-modern">
                            Cancel
                        </button>
                        <button type="button" 
                                wire:click="deleteDocument" 
                                class="btn-modern" 
                                @if(strlen($deletionReason) < 5) disabled @endif
                                style="@if(strlen($deletionReason) < 5) background: #9ca3af; cursor: not-allowed; color: #6b7280; @else background: #dc2626; color: white; @endif">
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
                toastr.success(event.detail.message, 'Success!');
            });

            // Upload success notification
            window.addEventListener('document-uploaded', event => {
                toastr.success(event.detail.message, 'Upload Successful!');
            });

            // Upload failure notification
            window.addEventListener('document-upload-failed', event => {
                toastr.error(event.detail.message, 'Upload Failed!');
            });

            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    if (document.querySelector('.upload-modal')) {
                        closeUploadModalWithAnimation();
                    } else if (document.querySelector('.edit-modal')) {
                        closeEditModal();
                    } else if (document.querySelector('.delete-modal')) {
                        closeDeleteModal();
                    }
                }
            });

            // Upload modal animation handling
            window.closeUploadModalWithAnimation = function() {
                const modal = document.querySelector('.upload-modal');
                if (modal) {
                    modal.classList.add('closing');
                    setTimeout(() => {
                        @this.call('closeUploadModal');
                    }, 250); // Match the animation duration
                }
            };

            // Edit modal animation handling
            window.closeEditModal = function() {
                const modal = document.querySelector('.edit-modal');
                if (modal) {
                    modal.classList.add('closing');
                    setTimeout(() => {
                        @this.call('closeEditModal');
                    }, 250); // Match the animation duration
                }
            };

            // Delete modal animation handling
            window.closeDeleteModal = function() {
                const modal = document.querySelector('.delete-modal');
                if (modal) {
                    modal.classList.add('closing');
                    setTimeout(() => {
                        @this.call('cancelDelete');
                    }, 250); // Match the animation duration
                }
            };

            // Override close button clicks to use animation
            document.addEventListener('click', function(e) {
                if (e.target.closest('.upload-modal-close') || 
                    (e.target.closest('.btn-secondary-modern') && e.target.textContent.trim() === 'Cancel')) {
                    e.preventDefault();
                    closeUploadModalWithAnimation();
                }
            });

            // Infinite scroll functionality
            let isLoading = false;
            
            function checkScroll() {
                if (isLoading) return;
                
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                const windowHeight = window.innerHeight;
                const documentHeight = document.documentElement.scrollHeight;
                
                // Trigger load more when user is 200px from bottom
                if (scrollTop + windowHeight >= documentHeight - 200) {
                    const loadMoreBtn = document.querySelector('.load-more-btn');
                    if (loadMoreBtn && !loadMoreBtn.disabled) {
                        isLoading = true;
                        loadMoreBtn.click();
                        
                        // Reset loading flag after a delay
                        setTimeout(() => {
                            isLoading = false;
                        }, 1000);
                    }
                }
            }
            
            // Add scroll event listener
            window.addEventListener('scroll', checkScroll);
            
            // Reset loading flag when Livewire finishes loading
            document.addEventListener('livewire:load', function() {
                isLoading = false;
            });
            
            // Reset loading flag after Livewire updates
            Livewire.hook('message.processed', (message, component) => {
                isLoading = false;
            });
            
            // Close modal when clicking backdrop
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('upload-modal')) {
                    closeUploadModalWithAnimation();
                } else if (e.target.classList.contains('edit-modal')) {
                    closeEditModal();
                } else if (e.target.classList.contains('delete-modal')) {
                    closeDeleteModal();
                }
            });
        });
    </script>
</div>
