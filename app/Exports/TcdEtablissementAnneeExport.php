<?php

namespace App\Exports;

use App\Models\AdminRoleUser;
use App\Models\Etablissement;
use App\Models\Parametresglobaux;
use Illuminate\Support\Facades\Auth;
use App\Models\TcdEtablissementAnnee;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class TcdEtablissementAnneeExport implements FromCollection, WithHeadings
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
            return TcdEtablissementAnnee::all()->where('id_annee', '=', $annee)
                ->where('id_etab', '=', $etablissement->id);
        } else {
            return TcdEtablissementAnnee::all()->where('id_annee', '=', $annee);
        }
    }
    public function headings(): array
    {
        return [
            'id',
            'id_etab',
            'id_annee',
            'existecloture',
            'problemeequipement',
            'libelleanneescolaire',
            'directiondepartementales_id',
            'denominationdd',
            'directionregionales_id',
            'denominationdr',
            'communes_id',
            'denominationcommune',
            'ordre_enseignement_id',
            'libelleenseignement',
            'denominationetab',
            'code',
            'datecreation',
            'numautorisationouverture',
            'numautorisationcreation',
            'capacite',
            'localisation',
            'adresse',
            'latitude',
            'longitude',
            'telephone',
            'email',
            'nomfondateur',
            'contact'
        ];
    }
}
