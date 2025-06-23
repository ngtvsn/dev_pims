<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SalaryGrade;
use File;

class SalaryGradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SalaryGrade::truncate();
        $json = File::get("database/data/salary_grades.json");
        $data = json_decode($json);
            foreach ($data as $obj) 
            {
                SalaryGrade::create(array(
                    'id' => $obj->id,
                    'salary_grade_name' => $obj->salary_grade_name,
                ));
            }
    }
}
