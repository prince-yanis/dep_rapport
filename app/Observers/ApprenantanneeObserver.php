<?php

namespace App\Observers;

use App\Models\Apprenantannee;
use App\Models\Classe;

class ApprenantanneeObserver
{
    public function saved(Apprenantannee $apprenantannee)
    {
        // Rafraîchir les données après que le trigger SQL ait modifié moyenneannee
        $apprenantannee->refresh();

        $moyenne = $apprenantannee->moyenneannee;

        if (!is_numeric($moyenne)) {
            return; // Rien à faire si pas de moyenne
        }

        $classe = Classe::with('groupepedagogique')->find($apprenantannee->classes_id);

        if (!$classe || !$classe->groupepedagogique) {
            return;
        }

        $groupe = $classe->groupepedagogique;

        // Définir l'observation selon la moyenne
        if ($moyenne < 7) {
            $observation = 'Très faible - Avertissement sérieux';
        } elseif ($moyenne < 9) {
            $observation = 'Faible - Avertissement';
        } elseif ($moyenne < 10) {
            $observation = 'Insuffisant';
        } elseif ($moyenne < 12) {
            $observation = 'Passable';
        } elseif ($moyenne < 14) {
            $observation = 'Assez bien - Tableau d honneur';
        } elseif ($moyenne < 16) {
            $observation = 'Bien - Tableau d honneur + Encouragements';
        } elseif ($moyenne < 17.5) {
            $observation = 'Très bien - Tableau d honneur + Félicitations';
        } elseif ($moyenne < 18.5) {
            $observation = 'Très bien - Félicitations Spéciales';
        } elseif ($moyenne < 19.5) {
            $observation = 'Très bien - Excellence';
        } else {
            $observation = 'Très bien - Excellence avec Mention';
        }

        // Appliquer la logique de décision selon le diplôme préparé et niveau
        if ($groupe->diplomeprepares_id == 1 && in_array($groupe->niveau_id, [4, 5])) {
            if ($moyenne >= 10) {
                $decision = 1; // Admis
            } elseif ($moyenne > 8.5 && $moyenne < 10) {
                $decision = 3; // Redouble
            } else {
                $decision = 4; // Exclu
            }
        } elseif ($groupe->diplomeprepares_id != 1 && in_array($groupe->niveau_id, [1, 2])) {
            $decision = ($moyenne >= 10) ? 1 : 4;
        } else {
            return; // Pas concerné par la logique métier
        }

        // Mettre à jour les champs concernés
        $apprenantannee->updateQuietly([
            'decision_id' => $decision,
            'observation' => $observation,
            'candidat'    => 'Non',
        ]);
    }
}
