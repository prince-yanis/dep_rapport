<?php

namespace App\Exports;

use App\Models\VFiliereEnseigne;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class VFiliereEnseigneExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return VFiliereEnseigne::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'observation',
            'numautorisationouverture',
            'filieres_id',
            'libellefiliere',
            'ordre_id',
            'libelleenseignement',
            'etablissementannees_id',
            'etablissements_id',
            'anneescolaires_id',
            'denominationetab',
            'libelleanneescolaire'
        ];
    }
}
