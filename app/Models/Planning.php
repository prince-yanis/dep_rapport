<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Planning
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $etablissementannees_id
 * @property \Carbon\Carbon $datedebut
 * @property \Carbon\Carbon $datefin
 * @property int|null $jours_id
 * @property int|null $heures_id
 * @property int|null $personnels_id
 * @property int|null $classes_id
 * @property int $disciplines_id
 * 
 * @property Class|null $class
 * @property Etablissementannee $etablissementannee
 * @property Heure|null $heure
 * @property Jour|null $jour
 * @property Personnel|null $personnel
 *
 * @package App\Models
 */
class Planning extends Model
{
	protected $table = 'planning';

	protected $casts = [
		'etablissementannees_id' => 'int',
		'jours_id' => 'int',
		'heures_id' => 'int',
		'personnels_id' => 'int',
		'classes_id' => 'int',
		'disciplines_id' => 'int'
	];
	
	protected $dates = [
		'datedebut',
		'datefin'
	];

	protected $fillable = [
		'etablissementannees_id',
		'datedebut',
		'datefin',
		'jours_id',
		'heures_id',
		'personnels_id',
		'classes_id',
		'disciplines_id'
	];

	public function classe()
	{
		return $this->belongsTo(Classe::class, 'classes_id');
	}
    public function discipline()
	{
		return $this->belongsTo(Discipline::class, 'disciplines_id');
	}
	public function etablissementannee()
	{
		return $this->belongsTo(Etablissementannee::class, 'etablissementannees_id');
	}

	public function heure()
	{
		return $this->belongsTo(Heure::class, 'heures_id');
	}

	public function jour()
	{
		return $this->belongsTo(Jour::class, 'jours_id');
	}

	public function personnel()
	{
		return $this->belongsTo(Personnel::class, 'personnels_id');
	}
}
