# Design Document: PDF Upload Functionality

## Overview

This design document outlines the implementation of a simple and reliable PDF file upload functionality within the existing upload document modal. The solution focuses on replacing the current problematic "Upload File" button with a standard "Choose File" button that works consistently across all browsers and provides clear user feedback.

## Architecture

The PDF upload functionality will be implemented as an enhancement to the existing upload document modal using:

- **HTML5 File API** for file selection and validation
- **Standard HTML file input** with proper styling and labeling
- **JavaScript event handlers** for file processing and validation
- **Bootstrap components** for consistent UI styling
- **Progress indicators** for upload status feedback

The implementation will follow these principles:
- Use native browser file input for maximum compatibility
- Provide immediate visual feedback for file selection
- Implement client-side validation before upload
- Maintain existing modal workflow and styling

## Components and Interfaces

### 1. File Selection Component

**Choose File Button**
- Implementation: Standard HTML `<input type="file">` with custom styling
- Appearance: Bootstrap button styled to match existing UI
- Behavior: Opens native browser file dialog when clicked
- File Filter: Restricted to PDF files only (`accept=".pdf"`)

**File Display Area**
- Location: Adjacent to the Choose File button
- Content: Shows selected file name and size
- States:
  - Empty: "No file selected"
  - Selected: "filename.pdf (2.3 MB)"
  - Error: Error message in red text

### 2. File Validation Component

**Client-Side Validation**
- File Extension: Must be `.pdf`
- File Size: Maximum 10MB
- File Type: MIME type verification (`application/pdf`)
- Error Display: Inline error messages below file selection

**Validation Flow**
```
File Selected → Extension Check → Size Check → MIME Type Check → Enable Form
     ↓              ↓              ↓              ↓
   Error         Error          Error        Success
```

### 3. Form Integration Component

**Form State Management**
- Initial State: Form fields disabled until valid file selected
- File Selected: Enable all form fields
- Validation Error: Keep form disabled, show error
- Form Complete: Enable "Upload Document" button

**Required Fields**
- Issuance Number (number input)
- Document Type (dropdown)
- Subject (textarea)
- Document Date (date input)

### 4. Upload Progress Component

**Progress Indicator**
- Type: Bootstrap progress bar
- States: Hidden → Visible → Complete
- Progress Text: "Uploading... 45%"
- Status Messages: "Uploading", "Processing", "Finalizing"

**Upload Flow**
```
Click Upload → Show Progress → Validate Server → Process File → Update Table → Close Modal
```

## Data Models

### File Model
```javascript
{
  file: File,           // Native File object
  name: String,         // File name
  size: Number,         // File size in bytes
  type: String,         // MIME type
  isValid: Boolean,     // Validation status
  errorMessage: String  // Error description if invalid
}
```

### Upload Model
```javascript
{
  file: File,           // Selected PDF file
  metadata: {
    issuanceNumber: Number,
    documentType: String,
    subject: String,
    documentDate: String
  },
  progress: Number,     // Upload progress (0-100)
  status: String,       // 'idle', 'uploading', 'processing', 'complete', 'error'
  errorMessage: String  // Error description if failed
}
```

## Implementation Details

### 1. HTML Structure

```html
<!-- File Selection Section -->
<div class="form-group">
  <label for="pdfFileInput">Select PDF File *</label>
  <div class="file-input-wrapper">
    <input type="file" id="pdfFileInput" accept=".pdf" class="d-none" required>
    <button type="button" id="chooseFileBtn" class="btn btn-outline-primary">
      <i class="fas fa-file-pdf mr-2"></i>Choose File
    </button>
    <span id="selectedFileName" class="ml-3 text-muted">No file selected</span>
  </div>
  <div id="fileError" class="invalid-feedback"></div>
  <small class="form-text text-muted">Select a PDF file (max 10MB)</small>
</div>
```

### 2. JavaScript Implementation

**File Selection Handler**
```javascript
$('#chooseFileBtn').on('click', function() {
  $('#pdfFileInput').click();
});

$('#pdfFileInput').on('change', function(e) {
  const file = e.target.files[0];
  if (file) {
    validateAndDisplayFile(file);
  }
});
```

**File Validation Function**
```javascript
function validateAndDisplayFile(file) {
  // Reset previous state
  clearFileError();
  
  // Validate file extension
  if (!file.name.toLowerCase().endsWith('.pdf')) {
    showFileError('Only PDF files are allowed');
    return;
  }
  
  // Validate file size (10MB = 10 * 1024 * 1024 bytes)
  if (file.size > 10485760) {
    showFileError('File size exceeds 10MB limit');
    return;
  }
  
  // Display file info and enable form
  displaySelectedFile(file);
  enableDocumentForm();
}
```

### 3. CSS Styling

```css
.file-input-wrapper {
  display: flex;
  align-items: center;
  margin-bottom: 0.5rem;
}

#selectedFileName {
  font-weight: 500;
}

#selectedFileName.file-selected {
  color: #28a745;
}

#selectedFileName.file-error {
  color: #dc3545;
}

.file-size {
  font-size: 0.875rem;
  color: #6c757d;
}
```

## Error Handling

### File Selection Errors

1. **Invalid File Type**
   - Message: "Only PDF files are allowed"
   - Action: Clear selection, keep form disabled

2. **File Too Large**
   - Message: "File size exceeds 10MB limit"
   - Action: Clear selection, keep form disabled

3. **No File Selected**
   - Message: "Please select a PDF file"
   - Action: Keep form disabled

### Upload Errors

1. **Network Error**
   - Message: "Upload failed due to network error. Please try again."
   - Action: Reset upload, allow retry

2. **Server Error**
   - Message: "Server error occurred. Please try again later."
   - Action: Reset upload, allow retry

3. **File Processing Error**
   - Message: "Unable to process PDF file. Please check the file and try again."
   - Action: Reset upload, allow file reselection

## Testing Strategy

### Unit Tests

1. **File Selection Tests**
   - Test choose file button triggers file input
   - Test file selection displays file name
   - Test file validation (extension, size, type)
   - Test error message display

2. **Form Integration Tests**
   - Test form enables after valid file selection
   - Test form remains disabled for invalid files
   - Test upload button enables when form complete

3. **Upload Process Tests**
   - Test progress bar display and updates
   - Test success handling and modal closure
   - Test error handling and retry capability

### Integration Tests

1. **Modal Integration**
   - Test file selection within modal context
   - Test modal reset after successful upload
   - Test modal behavior on upload errors

2. **Table Integration**
   - Test document appears in table after upload
   - Test table refresh after successful upload
   - Test document metadata display in table

## User Experience Flow

1. **Open Modal**: User clicks "Upload Document" button
2. **Select File**: User clicks "Choose File" → File dialog opens → User selects PDF
3. **File Validation**: System validates file → Shows file name or error
4. **Fill Form**: User completes document metadata form
5. **Upload**: User clicks "Upload Document" → Progress bar shows → Success message
6. **Complete**: Modal closes → Document appears in table

## Browser Compatibility

- **Chrome**: Full support for File API and file input styling
- **Firefox**: Full support with consistent behavior
- **Safari**: Full support with native file dialog
- **Edge**: Full support for modern file handling
- **Mobile**: Touch-friendly file selection on iOS/Android

This design ensures maximum compatibility by using standard HTML file inputs while providing a polished user experience through progressive enhancement.