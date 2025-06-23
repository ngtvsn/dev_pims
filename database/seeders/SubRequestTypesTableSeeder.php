<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubRequestType;
use File;

class SubRequestTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubRequestType::truncate();
        $json = File::get("database/data/sub_request_types.json");
        $data = json_decode($json);
            foreach ($data as $obj) 
            {
                SubRequestType::create(array(
                    'id' => $obj->id,
                    'request_type_id' => $obj->request_type_id,
                    'sub_request_type_name' => $obj->sub_request_type_name
                ));
            }
    }
}
