<?php

namespace App\Exports;

use App\Models\TcdSuiviRemplissage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class TcdSuiviRemplissageExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return TcdSuiviRemplissage::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'libelleanneescolaire',
            'DR',
            'denominationcommune',
            'libelleenseignement',
            'denominationetab',
            'code',
            'numautorisationouverture',
            'numautorisationcreation',
            'capacite',
            'localisation',
            'adresse',
            'telephone',
            'email',
            'nomfondateur',
            'contact',
            'rapport_rentrée',
            'rapport_1erSemestre',
            'rapport_2emeSemestre'
        ];
    }
}
