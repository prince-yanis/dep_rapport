<?php

namespace App\Exports;

use App\Models\VEtablissement;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class VEtablissementExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return VEtablissement::all();
    }

    public function headings(): array
    {
        return [
            'id',
		'denominationetab',
		'code',
		'numautorisationouverture',
		'numautorisationcreation',
		'telephone',
		'ordre_id',
		'ordre_libelle',
		'direction_id',
		'direction_libelle'
        ];
    }
}
