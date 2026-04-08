<?php

namespace App\Observers;

use App\Models\Apprenantannee;
use App\Models\Classe;

class DecisionAutoObserver
{
    /**
     * Handle the Apprenantannee "created" event.
     *
     * @param  \App\Models\Apprenantannee  $apprenantannee
     * @return void
     */
    public function created(Apprenantannee $apprenantannee)
    {
        //
    }

    /**
     * Handle the Apprenantannee "updated" event.
     *
     * @param  \App\Models\Apprenantannee  $apprenantannee
     * @return void
     */
    public function saving(Apprenantannee $apprenantannee)
{
    // Vérifie si la moyenne annuelle a été modifiée
    if (!$apprenantannee->isDirty('moyenneannee')) {
        return;
    }

    $classe = Classe::with('groupepedagogique')->find($apprenantannee->classes_id);
    if (!$classe || !$classe->groupepedagogique) {
        return;
    }

    $groupe = $classe->groupepedagogique;
    $moyenne = $apprenantannee->moyenneannee;

    if (!is_numeric($moyenne)) {
        return; // Ignore les valeurs vides ou non numériques
    }

    // Déterminer l'observation selon la moyenne
    if ($moyenne < 7) {
        $observation = 'Très faible - Avertissement sérieux';
    } elseif ($moyenne < 9) {
        $observation = 'Faible - Avertissement';
    } elseif ($moyenne < 10) {
        $observation = 'Insuffisant';
    } elseif ($moyenne < 12) {
        $observation = 'Passable';
    } elseif ($moyenne < 14) {
        $observation = 'Assez bien - Tableau d\'honneur';
    } elseif ($moyenne < 16) {
        $observation = 'Bien - Tableau d\'honneur + Encouragements';
    } elseif ($moyenne < 17.5) {
        $observation = 'Très bien - Tableau d\'honneur + Félicitations';
    } elseif ($moyenne < 18.5) {
        $observation = 'Très bien - Félicitations Spéciales';
    } elseif ($moyenne < 19.5) {
        $observation = 'Très bien - Excellence';
    } else {
        $observation = 'Très bien - Excellence avec Mention';
    }

    // Cas 1 : Diplôme préparé = 1 ET niveau = 4 ou 5
    if ($groupe->diplomeprepares_id == 1 && in_array($groupe->niveau_id, [4, 5])) {
        if ($moyenne >= 10) {
            $apprenantannee->decision_id = 1; // Admis
        } elseif ($moyenne > 8.5 && $moyenne < 10) {
            $apprenantannee->decision_id = 3; // Redouble
        } elseif ($moyenne < 8.5) {
            $apprenantannee->decision_id = 4; // Exclu
        }

        $apprenantannee->observation = $observation;
        $apprenantannee->candidat = 'Non';
        $apprenantannee->saveQuietly(); // éviter boucle infinie
    }

    // Cas 2 : Diplôme préparé ≠ 1 ET niveau = 1 ou 2
    elseif ($groupe->diplomeprepares_id != 1 && in_array($groupe->niveau_id, [1, 2])) {
        if ($moyenne >= 10) {
            $apprenantannee->decision_id = 1; // Admis
        } else {
            $apprenantannee->decision_id = 4; // Redouble ou exclu
        }

        $apprenantannee->observation = $observation;
        $apprenantannee->candidat = 'Non';
        $apprenantannee->saveQuietly();
    }
		
}

    /**
     * Handle the Apprenantannee "deleted" event.
     *
     * @param  \App\Models\Apprenantannee  $apprenantannee
     * @return void
     */
    public function deleted(Apprenantannee $apprenantannee)
    {
        //
    }

    /**
     * Handle the Apprenantannee "restored" event.
     *
     * @param  \App\Models\Apprenantannee  $apprenantannee
     * @return void
     */
    public function restored(Apprenantannee $apprenantannee)
    {
        //
    }

    /**
     * Handle the Apprenantannee "force deleted" event.
     *
     * @param  \App\Models\Apprenantannee  $apprenantannee
     * @return void
     */
    public function forceDeleted(Apprenantannee $apprenantannee)
    {
        //
    }
}
