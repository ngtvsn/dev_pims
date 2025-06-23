<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AvailedService;
use File;

class AvailedServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AvailedService::truncate();
        $json = File::get("database/data/availed_services.json");
        $data = json_decode($json);
            foreach ($data as $obj) 
            {
                AvailedService::create(array(
                    'id' => $obj->id,
                    'status_type_id' => $obj->status_type_id,
                    'service_type_id' => $obj->service_type_id,
                    'service_category_id' => $obj->service_category_id,
                    'availed_service_name' => $obj->availed_service_name,
                    'availed_service_name_short' => $obj->availed_service_name_short
                ));
            }
    }
}
