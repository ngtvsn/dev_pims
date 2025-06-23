<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TransactingOffice;
use File;

class TransactingOfficesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransactingOffice::truncate();
        $json = File::get("database/data/transacting_offices.json");
        $data = json_decode($json);
            foreach ($data as $obj) 
            {
                TransactingOffice::create(array(
                    'id' => $obj->id,
                    'office_type_id' => $obj->office_type_id,
                    'transacting_office_name' => $obj->transacting_office_name
                ));
            }
    }
}
