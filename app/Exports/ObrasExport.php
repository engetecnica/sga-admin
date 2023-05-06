<?php

namespace App\Exports;

use App\Models\CadastroObra;
use Maatwebsite\Excel\Concerns\FromCollection;

class ObrasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CadastroObra::all();
    }
}
