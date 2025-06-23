<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ClientType;
use File;

class ClientTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClientType::truncate();
        $json = File::get("database/data/client_types.json");
        $data = json_decode($json);
            foreach ($data as $obj) 
            {
                ClientType::create(array(
                    'id' => $obj->id,
                    'client_type_name' => $obj->client_type_name
                ));
            }
    }
}
