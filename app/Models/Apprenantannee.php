<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Apprenantannee
 * 
 * @property int $id
 * @property string|null $candidat
 * @property string|null $resultat
 * @property string|null $moyenne1er
 * @property string|null $moyenne2eme
 * @property string|null $moyenneannee
 * @property string|null $observation
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $classes_id
 * @property int $groupepedagogiques_id
 * @property int $niveau_id
 * @property int $diplomeprepares_id
 * @property int $filieres_id
 * @property int $apprenants_id
 * @property int $etablissementannees_id
 * @property int $statutapprenants_id
 * @property int $bourses_id
 * @property int $decision_id
 *
 * @package App\Models
 */
class Apprenantannee extends Model
{
    protected $table = 'apprenantannees';

    protected $casts = [
        'classes_id' => 'int',
        'groupepedagogiques_id' => 'int',
        'niveau_id' => 'int',               // ajouté
        'diplomeprepares_id' => 'int',     // ajouté
        'filieres_id' => 'int',             // ajouté
        'apprenants_id' => 'int',
        'etablissementannees_id' => 'int',
        'statutapprenants_id' => 'int',
        'bourses_id' => 'int',
        'decision_id' => 'int'
    ];

    protected $fillable = [
        'candidat',
        'resultat',
        'moyenne1er',
        'moyenne2eme',
        'moyenneannee',
        'observation',
        'classes_id',
        'groupepedagogiques_id',
        'niveau_id',               // ajouté
        'diplomeprepares_id',      // ajouté
        'filieres_id',             // ajouté
        'apprenants_id',
        'etablissementannees_id',
        'statutapprenants_id',
        'bourses_id',
        'decision_id'
    ];

    // relations (inchangées)
    public function apprenant()
    {
        return $this->belongsTo(Apprenant::class, 'apprenants_id');
    }
    public function groupepedagogique()
    {
        return $this->belongsTo(Groupepedagogique::class, 'groupepedagogiques_id');
    }
    public function niveau()
    {
        return $this->belongsTo(Niveau::class, 'niveau_id');
    }
    public function filiere()
    {
        return $this->belongsTo(Filiere::class, 'filieres_id');
    }
    public function diplomeprepare()
    {
        return $this->belongsTo(Diplomeprepare::class, 'diplomeprepares_id');
    }
    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classes_id');
    }
    public function etablissementannee()
    {
        return $this->belongsTo(Etablissementannee::class, 'etablissementannees_id');
    }
    public function statutapprenant()
    {
        return $this->belongsTo(Statutapprenant::class, 'statutapprenants_id');
    }
    public function bourse()
    {
        return $this->belongsTo(Bourse::class, 'bourses_id');
    }
    public function decision()
    {
        return $this->belongsTo(Decision::class, 'decision_id');
    }
}

