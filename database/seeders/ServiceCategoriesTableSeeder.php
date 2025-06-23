<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;
use File;

class ServiceCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceCategory::truncate();
        $json = File::get("database/data/service_categories.json");
        $data = json_decode($json);
            foreach ($data as $obj) 
            {
                ServiceCategory::create(array(
                    'id' => $obj->id,
                    'service_category_name' => $obj->service_category_name
                ));
            }
    }
}
