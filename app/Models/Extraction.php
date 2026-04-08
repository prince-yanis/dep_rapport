<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extraction extends Model
{
    // Nom de la table
    protected $table = 'extractions';

    // Clé primaire de la table
    protected $primaryKey = 'id';

    // Les colonnes pouvant être massivement assignées
    protected $fillable = [
        'code',
        'etablissement',
        'filiere',
        'diplome',
        'matricule',
        'nom',
        'prenoms',
        'genre',
        'niveau',
        'statut',
        'valide',
        'rejet',
        'ordre',
        'dr',
        'traite',
    ];

    // Indique si les timestamps (created_at, updated_at) sont utilisés
    public $timestamps = false;
}
