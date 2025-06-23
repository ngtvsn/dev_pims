<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VisibilityResponse;
use File;

class VisibilityResponsesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VisibilityResponse::truncate();
        $json = File::get("database/data/visibility_responses.json");
        $data = json_decode($json);
            foreach ($data as $obj) 
            {
                VisibilityResponse::create(array(
                    'id' => $obj->id,
                    'visibility_response_name' => $obj->visibility_response_name      
                ));
            }
    }
}
