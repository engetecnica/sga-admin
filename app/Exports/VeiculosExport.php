<?php

namespace App\Exports;

use App\Models\Veiculo;
use Maatwebsite\Excel\Concerns\FromCollection;

class VeiculosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Veiculo::all();
    }
}
