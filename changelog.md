# Changelog

## [Latest] - 2025-01-08

### Enhanced Upload Modal with Modern UI Design
- **Complete UI Redesign**: Redesigned the upload modal with a cleaner, more modern interface
- **Improved File Tabs**: Enhanced tab navigation with better styling, hover effects, and active state indicators
- **Unified Preview Container**: Created a cohesive preview container that adapts to single or multiple files
- **Better Visual Hierarchy**: Removed overlapping elements and improved spacing for better readability
- **Consistent Styling**: Unified color scheme and typography throughout the preview section
- **Enhanced Placeholders**: Improved placeholder states for upload, preview hidden, and non-PDF files
- **Responsive Design**: Better mobile and tablet compatibility with improved layout structure
- **Reduced Visual Clutter**: Eliminated complex gradients and overlapping borders that caused visual conflicts
- **Technical Improvements**: Streamlined CSS classes, removed redundant styles, and improved maintainability

### Previous PDF Preview and Tab Navigation Fixes
- **PDF Preview Display**: Corrected the PDF preview logic to properly access file objects for `temporaryUrl()` method
- **File Tab Navigation**: Implemented tab functionality to switch between multiple uploaded files for preview
- **Auto Preview**: Added automatic preview display when PDF files are uploaded
- **Backend Support**: Added `selectedFileIndex` property to track the currently viewed file in the preview
- **User Interface**: Enhanced file tab management with proper styling and active state indicators
- **File Management**: Improved `removeFile` method to handle `selectedFileIndex` reset when files are removed
- **Technical Details**: Fixed file object access in blade template for proper `temporaryUrl()` generation, updated `updatedUploadFormFiles` method to auto-show preview for PDF files, and enhanced `resetUploadForm` and `removeFile` methods to manage file selection state

## [2025-01-08]

### Implemented Infinite Scroll with 12 Cards Per Load
- **Removed Pagination**: Eliminated traditional pagination controls and "Per Page" dropdown
- **Infinite Scroll System**: Implemented automatic loading when user scrolls within 200px of bottom
- **12 Cards Per Load**: Each load operation fetches exactly 12 documents for optimal performance
- **Load More Button**: Added manual "Load More Documents" button with loading states and animations
- **Smart Filter Integration**: When filters are applied, the list resets to show first 12 items
- **End Detection**: Shows "All documents loaded" indicator when no more items are available
- **Backend Optimization**: Removed WithPagination trait and implemented loadMore() method with loadedItems tracking
- **Frontend Enhancement**: Added automatic scroll detection JavaScript with loading prevention logic
- **Visual Improvements**: Styled load more button and indicators to match existing green theme
- **Performance Optimized**: Progressive loading maintains fast response times while browsing large datasets
- **Bug Fix**: Removed pagination-related properties ($page, $perPage) from queryString array to prevent PropertyNotFoundException
- **Bug Fix**: Replaced all `resetPage()` method calls with `resetLoadedItems()` to fix "Method does not exist" error after removing WithPagination trait

### Added
- **Enhanced Modal Animations** (2024-12-19)
  - Added smooth fade-in/fade-out and slide animations for edit and delete modals
  - Implemented consistent animation timing (250ms) across all modal interactions
  - Enhanced keyboard shortcuts (Escape key) to handle all modal types with animations
  - Added backdrop click handling for animated modal closing
  - Improved visual consistency and user experience with professional transitions

### Bug Fixes
- **Fixed Missing File Display on Issuance Cards** (2024-12-19)
  - Added conditional checks in `list-issuances.blade.php` to handle documents without file attachments
  - Document titles now display properly whether files are attached or not
  - Added "No file attached" indicator for documents without files
  - Fixed version links to only show when file_path exists
  - Fixed edit modal to handle missing current file paths gracefully
  - Prevents broken links and improves user experience for documents without attachments

### Fixed PDF File Access Issue
- **Storage Link Configuration**: Fixed symbolic link between public/storage and storage/app/public
- **APP_URL Correction**: Updated APP_URL in .env from http://127.0.0.1:8000 to http://localhost:8001
- **File Accessibility**: All uploaded PDF files are now properly accessible via hyperlinks
- **Cache Clearing**: Cleared configuration and application cache to ensure changes take effect
- **Database Storage Verification**: Confirmed files are properly stored in database with correct file paths

### Enhanced Hover Text Expansion
- **Coordinated Card Movement**: Entire card body now expands cohesively on hover
- **Title and Metadata Movement**: Document title, type, and date move together during expansion
- **Enhanced Visual Feedback**: Added elevation effect with subtle shadow on hover
- **Improved Spacing**: Better padding and border radius for expanded state
- **Smooth Transitions**: Coordinated animations for all expanding elements
- **Better Link Styling**: Proper cursor pointer and text decoration handling

## [Unreleased]

### Added
- Upgraded upload modal to support multiple file uploads with single issuance creation
  - Increased file size limit from 10MB to 15MB per file
  - Added support for uploading multiple files simultaneously as one issuance
  - Enhanced file management with individual file removal capability
  - Updated upload form structure from single `file` to `files` array
  - Added `uploadedFiles` property for managing selected files
  - Implemented file validation for each uploaded file (15MB limit, PDF/DOC/DOCX types)
  - Fixed PDF preview functionality to work with multiple file uploads
  - Added file tab navigation for switching between multiple selected files
  - Implemented `selectedFileIndex` property to track currently viewed file
  - Modified upload logic to create one primary document with additional files as attachments
  - Added helper methods: `updatedUploadFormFiles`, `removeFile`, `formatFileSize`
  - Enhanced error handling and success messaging for single issuance uploads
  - Improved file tab management with automatic index adjustment when files are removed
- Implemented document versioning. When a document is edited, a new version is created, and the original is archived. The version history is now displayed on the document card.
- The document title is now a hyperlink to the PDF file.
- Enhanced search input fields with icons and clear buttons for better user experience
- Visual search indicators (search icon for subject search, hashtag icon for issuance number)
- Interactive clear buttons that appear when search fields contain text

### Changed
- Improved card filter UI/UX with better text wrapping and readability
- Enhanced document title display with proper word wrapping and text overflow handling
- Improved document number display with better text wrapping
- Enhanced filter section with responsive grid layout and better spacing
- Improved meta information display with better alignment and spacing
- Enhanced form controls with better hover effects and visual feedback
- Upgraded action buttons with improved hover states and accessibility
- Reverted 'See More' button functionality in favor of hover-to-expand text behavior for better user experience
- Implemented mini cards layout with compact dimensions and hover text expansion
- Optimized typography with smaller font sizes while maintaining readability

### Fixed
- Fixed text wrapping issues in document cards and filter sections
- Resolved readability problems with long document titles and numbers
- Fixed responsive layout issues in filter grid
- Resolved critical database migration failures:
  - Corrected migration order dependency for `document_sub_types` table by renaming the migration file and removing the old conflicting file.
  - Added missing soft delete columns (`deleted_at`, `deleted_by`, `deletion_reason`) to the `issuance_documents` table creation migration to prevent downstream errors.
- Executed a fresh migration (`php artisan migrate:fresh`) to successfully build the database schema.
- Initiated database seeding to populate the tables.
- Standardized application URL configuration by correcting fallback URLs in `config/app.php` and `config/livewire.php` to use `127.0.0.1:8000`.
- Removed redundant `database.php` from the root directory to prevent configuration conflicts.
- Corrected the `updateDocument` method in `ListIssuances.php` to properly handle `null` values for `issuance_number` and `document_sub_type_id` when they are not provided in the edit form. This prevents potential database errors when these fields are intentionally left empty.
- Refactored the Edit Document modal to use Bootstrap classes, ensuring a consistent look and feel with the rest of the application.

## [2024-01-XX] - Card Filter UI/UX Improvements

### Enhanced Search Experience
- **Added visual search indicators**: Integrated search icons (magnifying glass for subject search, hashtag for issuance number) to improve user recognition
- **Interactive clear buttons**: Added "×" clear buttons with hover effects for quick field clearing
- **Improved input styling**: Enhanced search input fields with better padding, borders, and focus states

### Mini Cards Layout with Enhanced Hover Text Expansion
- **Implemented compact mini cards**: Reduced card dimensions and spacing for better space efficiency
- **Optimized typography**: Smaller font sizes while maintaining readability (titles: 0.875rem → 0.8rem compact, meta: 0.75rem → 0.7rem compact)
- **Enhanced hover-to-expand functionality**: Entire card body expands on hover with cohesive movement of title and metadata
- **Improved hover effects**: Card elevation with subtle upward transform, enhanced shadow, and coordinated content expansion
- **Reverted 'See More' button**: Removed manual expansion controls in favor of intuitive hover behavior
- **Enhanced document numbers**: Compact styling with hover effects and better truncation
- **Coordinated metadata movement**: Type and Document Date move together with title expansion for better visual flow

### Text Wrapping and Readability
- **Fixed document title overflow**: Implemented proper text wrapping with `word-wrap: break-word` and `overflow-wrap: break-word`
- **Enhanced text truncation**: Added `-webkit-line-clamp` for clean text limiting (2 lines normal, 1 line compact)
- **Improved hover interactions**: Smooth transitions with background highlighting and elevated appearance
- **Better meta information display**: Enhanced spacing and alignment for document metadata

### Responsive Design Improvements
- **Optimized grid layout**: Improved `document-cards-container` with better `minmax` values for responsive columns
- **Enhanced mobile experience**: Added responsive breakpoints for better mobile card display
- **Improved spacing**: Optimized gaps and padding throughout the card layout for compact design

### User Experience Enhancements
- **Enhanced hover effects**: Added smooth transitions and visual feedback for interactive elements
- **Improved button states**: Better styling for action buttons with hover and focus states
- **Enhanced filter interactions**: Improved form controls with modern styling and better user feedback
- **Intuitive text expansion**: Hover-based text expansion provides better user control than manual buttons

### Technical Improvements
- **CSS optimization**: Streamlined styles for better performance and maintainability
- **Accessibility improvements**: Enhanced color contrast and keyboard navigation
- **Cross-browser compatibility**: Ensured consistent behavior across different browsers
- **Removed unnecessary complexity**: Eliminated Alpine.js dependencies for expandable content

### Files Modified
- `resources/views/livewire/pages/issuance/list-issuances.blade.php` - Updated card filter UI/UX with mini cards layout, hover text expansion, and enhanced search functionality

## [v1.0.1] - 2024-08-02

### Fixed
- **Fix**: Changed `wire:model` to `wire:model.defer` in the upload document modal (`list-issuances.blade.php`) to prevent the PDF preview from continuously refreshing on every input change. This improves user experience by avoiding unnecessary re-renders.
- **Feature**: Modified the upload document form by removing the 'Description' field and converting the 'Document Title' input into a `textarea`. This simplifies the form and allows for more detailed titles. The `ListIssuances.php` component was updated to remove the corresponding logic and validation.