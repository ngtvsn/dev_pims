<?php

namespace App\Exports;

use App\Models\IctRequest;
use Maatwebsite\Excel\Concerns\FromCollection;

class IctRequestsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return IctRequest::all();
    }
}
