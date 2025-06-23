<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RequestType;
use File;

class RequestTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RequestType::truncate();
        $json = File::get("database/data/request_types.json");
        $data = json_decode($json);
            foreach ($data as $obj) 
            {
                RequestType::create(array(
                    'id' => $obj->id,
                    'request_type_name' => $obj->request_type_name
                ));
            }
    }
}
