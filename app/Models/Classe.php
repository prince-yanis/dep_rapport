<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Classe Class
 * 
 * @property int $id
 * @property string|null $denominationclasse
 * @property string|null $effectif_total
 * @property string $effectif_gar
 * @property string $effectif_fil
 * @property string $effectif_boursier
 * @property string $effectif_nonboursier
 * @property string $effectif_affecte
 * @property string $effectif_nonaffecte
 * @property string $planning
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $groupepedagogiques_id
 * @property int $etablissementannees_id
 * 
 * @property Etablissementannee $etablissementannee
 * @property Groupepedagogique $groupepedagogique
 * @property Collection|Planning[] $plannings
 *
 * @package App\Models
 */
class Classe extends Model
{
	protected $table = 'classes';

	protected $casts = [
		'groupepedagogiques_id' => 'int',
		'etablissementannees_id' => 'int'
	];

	protected $fillable = [
		'denominationclasse',
		'effectif_total',
		'planning',
		'effectif_gar',
		'effectif_fil',
		'effectif_boursier',
		'effectif_nonboursier',
		'effectif_affecte',
		'type_cours',
		'effectif_nonaffecte',
		'groupepedagogiques_id',
		'etablissementannees_id'
	];
   
	public function etablissementannee()
	{
		return $this->belongsTo(Etablissementannee::class, 'etablissementannees_id');
	}

	public function groupepedagogique()
	{
		return $this->belongsTo(Groupepedagogique::class, 'groupepedagogiques_id');
	}

	public function plannings()
	{
		return $this->hasMany(Planning::class, 'classes_id');
	}
	public function apprenantannees()
	{
		return $this->hasMany(Apprenantannee::class, 'classes_id');
	}
}
