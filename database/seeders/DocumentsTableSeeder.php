<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IssuancesDocument;
use App\Models\IssuancesDocumentType;
use App\Models\IssuancesDocumentSubType;
use App\Models\IssuancesDocumentStatusType;
use App\Models\Office;
use App\Models\User;
use Carbon\Carbon;

class DocumentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample document status types if they don't exist
        $statusTypes = [
            ['id' => 1, 'documents_status_type_name' => 'Draft'],
            ['id' => 2, 'documents_status_type_name' => 'Published'],
            ['id' => 3, 'documents_status_type_name' => 'Archived'],
        ];

        foreach ($statusTypes as $statusType) {
            IssuancesDocumentStatusType::firstOrCreate(
                ['id' => $statusType['id']],
                $statusType
            );
        }

        // Create sample offices if they don't exist
        $offices = [
            ['id' => 1, 'office_name' => 'Office of the Director'],
            ['id' => 2, 'office_name' => 'Human Resource Management Office'],
            ['id' => 3, 'office_name' => 'Finance and Administrative Division'],
        ];

        foreach ($offices as $office) {
            Office::firstOrCreate(
                ['id' => $office['id']],
                $office
            );
        }

        // Get the first user as creator/updater
        $user = User::first();
        $userId = $user ? $user->id : 1;

        // Sample issuance documents
        $documents = [
            [
                'document_reference_code' => 'PITAHC-2024-001',
                'document_title' => 'Updated COVID-19 Safety Protocols for All Personnel',
                'document_type_id' => 10, // Issuances
                'document_sub_type_id' => 19, // Memorandum
                'status_type_id' => 2, // Published
                'office_id' => 1,
                'created_by' => $userId,
                'updated_by' => $userId,
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now()->subDays(15),
            ],
            [
                'document_reference_code' => 'PITAHC-2024-002',
                'document_title' => 'Implementation of New Work-from-Home Policy',
                'document_type_id' => 10, // Issuances
                'document_sub_type_id' => 20, // PITAHC Personnel Order
                'status_type_id' => 2, // Published
                'office_id' => 2,
                'created_by' => $userId,
                'updated_by' => $userId,
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDays(10),
            ],
            [
                'document_reference_code' => 'PITAHC-2024-003',
                'document_title' => 'Annual Performance Evaluation Guidelines',
                'document_type_id' => 10, // Issuances
                'document_sub_type_id' => 21, // PITAHC Order
                'status_type_id' => 2, // Published
                'office_id' => 2,
                'created_by' => $userId,
                'updated_by' => $userId,
                'created_at' => Carbon::now()->subDays(7),
                'updated_at' => Carbon::now()->subDays(7),
            ],
            [
                'document_reference_code' => 'PITAHC-2024-004',
                'document_title' => 'Budget Allocation for Q4 2024 Operations',
                'document_type_id' => 10, // Issuances
                'document_sub_type_id' => 19, // Memorandum
                'status_type_id' => 2, // Published
                'office_id' => 3,
                'created_by' => $userId,
                'updated_by' => $userId,
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'document_reference_code' => 'PITAHC-2024-005',
                'document_title' => 'New Employee Orientation Schedule for December 2024',
                'document_type_id' => 10, // Issuances
                'document_sub_type_id' => 20, // PITAHC Personnel Order
                'status_type_id' => 2, // Published
                'office_id' => 2,
                'created_by' => $userId,
                'updated_by' => $userId,
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(3),
            ],
            [
                'document_reference_code' => 'PITAHC-2024-006',
                'document_title' => 'Holiday Schedule and Office Closure Dates',
                'document_type_id' => 10, // Issuances
                'document_sub_type_id' => 19, // Memorandum
                'status_type_id' => 2, // Published
                'office_id' => 1,
                'created_by' => $userId,
                'updated_by' => $userId,
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'document_reference_code' => 'PITAHC-2024-007',
                'document_title' => 'IT Security Policy Updates and Compliance Requirements',
                'document_type_id' => 10, // Issuances
                'document_sub_type_id' => 21, // PITAHC Order
                'status_type_id' => 2, // Published
                'office_id' => 1,
                'created_by' => $userId,
                'updated_by' => $userId,
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'document_reference_code' => 'PITAHC-2024-008',
                'document_title' => 'Emergency Response Procedures and Contact Information',
                'document_type_id' => 10, // Issuances
                'document_sub_type_id' => 19, // Memorandum
                'status_type_id' => 1, // Draft
                'office_id' => 1,
                'created_by' => $userId,
                'updated_by' => $userId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($documents as $document) {
            IssuancesDocument::firstOrCreate(
                ['document_reference_code' => $document['document_reference_code']],
                $document
            );
        }
    }
}