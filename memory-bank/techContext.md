# PIMS Technology Context

This document outlines the technology stack and key dependencies of the Personnel Information Management System (PIMS) as of the beginning of the Laravel 9 upgrade project.

## Core Technologies

*   **PHP:** ^7.3|^8.0
*   **Laravel Framework:** ^8.12
*   **Livewire:** ^2.3

## Key Dependencies

*   **`fideloper/proxy`:** ^4.4 (To be removed during upgrade)
*   **`guzzlehttp/guzzle`:** ^7.0.1
*   **`infyomlabs/laravel-ui-adminlte`:** ^3.1
*   **`kwn/number-to-words`:** ^2.9
*   **`laravel/tinker`:** ^2.5
*   **`maatwebsite/excel`:** ^3.1
*   **`nesbot/carbon`:** ^2.45
*   **`owen-it/laravel-auditing`:** ^12.0
*   **`rappasoft/laravel-livewire-tables`:** ^1.6 (High-risk dependency requiring significant refactoring)

## Development Dependencies

*   **`facade/ignition`:** ^2.5 (To be replaced with `spatie/laravel-ignition`)
*   **`fakerphp/faker`:** ^1.9.1
*   **`laravel/sail`:** ^1.0.1
*   **`mockery/mockery`:** ^1.4.2
*   **`nunomaduro/collision`:** ^5.0 (To be updated)
*   **`phpunit/phpunit`:** ^9.3.3
