<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentRecipient;

class DocumentRecipientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocumentRecipient::create(['name' => 'All Employees']);
        DocumentRecipient::create(['name' => 'All Offices']);
        DocumentRecipient::create(['name' => 'All Divisions']);
        DocumentRecipient::create(['name' => 'Office of the Director']);
        DocumentRecipient::create(['name' => 'Administrative Division']);
        DocumentRecipient::create(['name' => 'Finance Division']);
        DocumentRecipient::create(['name' => 'Technical Division']);
    }
}
