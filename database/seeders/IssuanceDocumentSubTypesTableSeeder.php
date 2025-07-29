<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IssuancesDocumentSubType;

class IssuanceDocumentSubTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // PITAHC Issuance Document Sub-Types (document_type_id = 10)
        $issuanceSubTypes = [
            [
                'id' => 19,
                'document_type_id' => 10,
                'document_sub_type_name' => 'PITAHC Memorandum'
            ],
            [
                'id' => 20,
                'document_type_id' => 10,
                'document_sub_type_name' => 'PITAHC Order'
            ],
            [
                'id' => 21,
                'document_type_id' => 10,
                'document_sub_type_name' => 'PITAHC Advisory'
            ],
            [
                'id' => 22,
                'document_type_id' => 10,
                'document_sub_type_name' => 'PITAHC Personnel Order'
            ],
        ];

        foreach ($issuanceSubTypes as $subType) {
            IssuancesDocumentSubType::firstOrCreate(
                ['id' => $subType['id']],
                $subType
            );
        }
    }
}