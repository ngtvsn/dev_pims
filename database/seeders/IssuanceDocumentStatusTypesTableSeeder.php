<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IssuancesDocumentStatusType;

class IssuanceDocumentStatusTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}