<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IssuancesDocumentType;
use Illuminate\Support\Facades\File;

class IssuancesDocumentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('data/document_types.json');
        
        if (File::exists($jsonPath)) {
            $documentTypes = json_decode(File::get($jsonPath), true);
            
            foreach ($documentTypes as $documentType) {
                IssuancesDocumentType::firstOrCreate(
                    ['id' => $documentType['id']],
                    $documentType
                );
            }
        }
    }
}