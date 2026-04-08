<?php

namespace App\Exports;

use App\Models\VResultatsScolaire;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class VResultatsScolaireExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return VResultatsScolaire::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'total_admis',
            'taux',
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
