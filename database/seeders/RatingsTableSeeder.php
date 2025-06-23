<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rating;
use File;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rating::truncate();
        $json = File::get("database/data/ratings.json");
        $data = json_decode($json);
            foreach ($data as $obj) 
            {
                Rating::create(array(
                    'id' => $obj->id,
                    'rating_name' => $obj->rating_name
                ));
            }
    }
}
