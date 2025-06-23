<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RequestStatusType;
use File;


class RequestStatusTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RequestStatusType::truncate();
        $json = File::get("database/data/request_status_types.json");
        $data = json_decode($json);
            foreach ($data as $obj) 
            {
                RequestStatusType::create(array(
                    'id' => $obj->id,
                    'request_status_type_name' => $obj->request_status_type_name
                ));
            }
    }
}
