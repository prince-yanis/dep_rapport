<?php

namespace App\Exports;

use App\Models\AdminRoleUser;
use App\Models\Etablissement;
use App\Models\Parametresglobaux;
use Illuminate\Support\Facades\Auth;
use App\Models\TcdEtablissementPersonnel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class TcdEtablissementPersonnelExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $current_user = Auth::guard('admin')->user();
        $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
        $etablissement = Etablissement::where('email', '=', $current_user->username)->first();
        $annee = Parametresglobaux::findOrFail(1)->anneescolaires_id;
        if (in_array($current_role->role_id, array(2))) {
            return TcdEtablissementPersonnel::all()->where('id_annee', '=', $annee)
            ->where('id_etab', '=', $etablissement->id);
        }
        else {
        return TcdEtablissementPersonnel::all()->where('id_annee', '=', $annee);
        }
    }
    public function headings(): array {
        return [
            'id',
            'etablissementannees_id',
            'id_etab',
            'id_annee',
            'denominationetab',
            'libelleanneescolaire',
            'directiondepartementales_id',
            'DR',
            'ordre_enseignement_id',
            'libelleenseignement',      
            'personnels_id',      
            'matricule',      
            'nom',      
            'prenoms',      
            'datenaissance',      
            'lieunaissance',      
            'sexe',      
            'telephone',      
            'email',      
            'numeroautorisation',      
            'documentautorisation',      
            'cv',      
            'typepersonnels_id',      
            'libelletypepersonnel',      
            'diplomepersonnels_id',      
            'libellediplome',      
            'disciplines_id',      
            'libellediscipline',      
            'niveauenseignant_id',      
            'libelleniveau',      
            'statutpersonnel_id',      
            'libellestatutpers',      
            'fonctionpersonnels_id',      
            'libellefonction'     
        ];
      }
}
