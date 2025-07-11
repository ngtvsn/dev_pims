# PIMS Progress

This document tracks the progress of the PIMS Laravel 9 upgrade.

## Current Status

The project has moved past the initial setup and UI modernization phase. The current focus is on updating the core dependencies to ensure compatibility with Laravel 9.

## Completed Tasks

*   **Modernized `module-selector` page:** The module selection interface has been updated with a modern, card-based design and improved interactivity.

## What Works

*   The application is fully functional on Laravel 8.
*   The `module-selector` page has been successfully modernized.

## What's Left to Build

*   Update all dependencies in `composer.json`.
*   Refactor all Livewire components for Laravel 9 compatibility.
*   Update the core Laravel codebase.
*   Thoroughly test the application after the upgrade.

## Known Issues

*   The `rappasoft/laravel-livewire-tables` package is a significant compatibility risk and will require a major version upgrade and extensive refactoring.
