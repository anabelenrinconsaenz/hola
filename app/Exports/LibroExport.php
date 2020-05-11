<?php

namespace App\Exports;

use App\libro;
use Maatwebsite\Excel\Concerns\FromCollection;

class LibroExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return libro::all();
    }
}
