# PIMS Progress

This document tracks the progress of the PIMS Laravel 9 upgrade.

## Current Status

The project is currently in the initial phase of the upgrade process. The Memory Bank has been created, and the next step is to begin updating the project's dependencies.

## What Works

*   The application is fully functional on Laravel 8.

## What's Left to Build

*   Modernize the `module-selector` page.
*   Update all dependencies in `composer.json`.
*   Refactor all Livewire components for Laravel 9 compatibility.
*   Update the core Laravel codebase.
*   Thoroughly test the application after the upgrade.

## Known Issues

*   The `rappasoft/laravel-livewire-tables` package is a significant compatibility risk and will require a major version upgrade and extensive refactoring.
