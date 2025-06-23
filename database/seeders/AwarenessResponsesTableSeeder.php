<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AwarenessResponse;
use File;

class AwarenessResponsesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AwarenessResponse::truncate();
        $json = File::get("database/data/awareness_responses.json");
        $data = json_decode($json);
            foreach ($data as $obj) 
            {
                AwarenessResponse::create(array(
                    'id' => $obj->id,
                    'awareness_response_name' => $obj->awareness_response_name
                ));
            }
    }
}
