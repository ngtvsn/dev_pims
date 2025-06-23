<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HelpfulnessResponse;
use File;

class HelpfulnessResponsesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HelpfulnessResponse::truncate();
        $json = File::get("database/data/helpfulness_responses.json");
        $data = json_decode($json);
            foreach ($data as $obj) 
            {
                HelpfulnessResponse::create(array(
                    'id' => $obj->id,
                    'helpfulness_response_name' => $obj->helpfulness_response_name
                ));
            }
    }
}
