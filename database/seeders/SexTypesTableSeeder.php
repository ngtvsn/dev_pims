<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SexType;
use File;

class SexTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SexType::truncate();
        $json = File::get("database/data/sex_types.json");
        $data = json_decode($json);
            foreach ($data as $obj) 
            {
                SexType::create(array(
                    'id' => $obj->id,
                    'sex_type_name' => $obj->sex_type_name
                ));
            }
    }
}
