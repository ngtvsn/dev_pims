<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClientGroup;
use File;

class ClientGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClientGroup::truncate();
        $json = File::get("database/data/client_groups.json");
        $data = json_decode($json);
            foreach ($data as $obj) 
            {
                ClientGroup::create(array(
                    'id' => $obj->id,
                    'client_group_name' => $obj->client_group_name
                ));
            }
    }
}
