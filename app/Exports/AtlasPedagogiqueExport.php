<?php

namespace App\Exports;

use App\Models\AtlasPedagogique;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AtlasPedagogiqueExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AtlasPedagogique::all();
    }
    public function headings(): array {
        return [
            'id_etab',
            'denominationetab',
            'directiondepartementales_id',
            'denominationdd',
            'directionregionales_id',
            'denominationdr'       
        ];
      }
}
