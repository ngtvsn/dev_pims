<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Division;
use File;

class DivisionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Division::truncate();
        $json = File::get("database/data/divisions.json");
        $data = json_decode($json);
            foreach ($data as $obj) 
            {
                Division::create(array(
                    'id' => $obj->id,
                    'division_name' => $obj->division_name
                ));
            }
    }
}
