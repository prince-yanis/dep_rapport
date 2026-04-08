<?php

namespace App\Exports;

use App\Models\AdminRoleUser;
use App\Models\Etablissement;
use App\Models\Parametresglobaux;
use App\Models\TcdActiviteSportive;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class TcdActiviteSportiveExport implements FromCollection,WithHeadings
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
            return TcdActiviteSportive::all()->where('id_annee', '=', $annee)
            ->where('id_etab', '=', $etablissement->id);
        }
        else {
        return TcdActiviteSportive::all()->where('id_annee', '=', $annee);
        }
    }
    public function headings(): array {
        return [
            'id',
            'etablissementannees_id',
            'id_etab',
            'id_annee',
            'sport_id',
            'libellesport',
            'denominationetab',
            'libelleanneescolaire',
            'directiondepartementales_id',
            'denominationdd',
            'directionregionales_id',
            'denominationdr'       
        ];
      }
}
