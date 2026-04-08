<?php

namespace App\Exports;

use App\Models\VRubriqueEtab;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VrubriqueExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return VRubriqueEtab::all();
    }
	
	public function headings(): array {
        return [
        'id',
		'rubriquecontrole_id',
		'mission_id',
		'recommandation',
		'observation',
		'periode_execution',
		'rubriquecontroles_id',
		'libellerubrique',
		'missions_id',
		'etablissementannees_id',
		'etabannee_id',
		'etablissements_id',
		'anneescolaires_id',
		'denominationetab',
		'libelleanneescolaire'
        ];
      }
}
