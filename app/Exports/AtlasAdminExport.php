<?php

namespace App\Exports;

use App\Models\AtlasAdmin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AtlasAdminExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AtlasAdmin::all();
    }
    public function headings(): array {
        return [
            'id_etab',
            'denominationetab',
            'id_district',
            'denominationdistrict',
            'id_region',
            'denominationregion',
            'id_departement',
            'denominationdepartement',
            'id_commune',
            'denominationcommune'       
        ];
      }
}
