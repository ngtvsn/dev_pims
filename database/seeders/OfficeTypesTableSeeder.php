<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OfficeType;
use File;

class OfficeTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OfficeType::truncate();
        $json = File::get("database/data/office_types.json");
        $data = json_decode($json);
            foreach ($data as $obj) 
            {
                OfficeType::create(array(
                    'id' => $obj->id,
                    'office_type_name' => $obj->office_type_name
                ));
            }
    }
}
