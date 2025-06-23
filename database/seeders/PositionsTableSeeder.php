<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;
use File;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::truncate();
        $json = File::get("database/data/positions.json");
        $data = json_decode($json);
            foreach ($data as $obj) 
            {
                Position::create(array(
                    'id' => $obj->id,
                    'salary_grade_id' => $obj->salary_grade_id,
                    'position_name' => $obj->position_name,
                ));
            }
    }
}
