<?php

namespace App\Admin\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\Anneescolaire;
use Encore\Admin\Controllers\AuthController as BaseAuthController;

class AuthController extends BaseAuthController
{
    protected function authenticated(Request $request, $user)
    {
        // Récupérer l'année scolaire associée à l'utilisateur
        $anneeScolaire = Anneescolaire::where('user_id', $user->id)->first(); // Ajustez la requête selon votre logique
    
        if ($anneeScolaire && $anneeScolaire->rapport1) {
            // Récupérer la date de rapport1
            $rapport1Date = $anneeScolaire->rapport1;
    
            // Calculer la différence en jours
            $rapport1 = Carbon::parse($rapport1Date);
            $today = Carbon::now();
            $daysDifference = $today->diffInDays($rapport1);
    
            // Stocker la différence dans la session
            session(['days_difference' => $daysDifference]);
        }
    
        // Vous pouvez également rediriger l'utilisateur ou effectuer d'autres actions ici
    }
}
