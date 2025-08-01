# Changelog

## [Unreleased]

### Fixed
- Resolved critical database migration failures:
  - Corrected migration order dependency for `document_sub_types` table by renaming the migration file and removing the old conflicting file.
  - Added missing soft delete columns (`deleted_at`, `deleted_by`, `deletion_reason`) to the `issuance_documents` table creation migration to prevent downstream errors.
- Executed a fresh migration (`php artisan migrate:fresh`) to successfully build the database schema.
- Initiated database seeding to populate the tables.
- Standardized application URL configuration by correcting fallback URLs in `config/app.php` and `config/livewire.php` to use `127.0.0.1:8000`.
- Removed redundant `database.php` from the root directory to prevent configuration conflicts.