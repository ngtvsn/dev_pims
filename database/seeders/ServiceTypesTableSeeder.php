<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServiceType;
use File;

class ServiceTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceType::truncate();
        $json = File::get("database/data/service_types.json");
        $data = json_decode($json);
            foreach ($data as $obj) 
            {
                ServiceType::create(array(
                    'id' => $obj->id,
                    'service_type_name' => $obj->service_type_name
                ));
            }
    }
}
