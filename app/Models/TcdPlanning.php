<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TcdPlanning
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property string|null $denominationetab
 * @property string|null $libelleanneescolaire
 * @property int|null $directiondepartementales_id
 * @property string|null $denominationdd
 * @property int|null $directionregionales_id
 * @property string|null $denominationdr
 * @property int|null $jours_id
 * @property string|null $libellejours
 * @property int|null $heures_id
 * @property string|null $libelleheures
 * @property int|null $classes_id
 * @property string|null $denominationclasse
 * @property int|null $personnels_id
 * @property string|null $nom
 * @property string|null $prenoms
 *
 * @package App\Models
 */
class TcdPlanning extends Model
{
	protected $table = 'tcd_planning';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'etablissementannees_id' => 'int',
		'directiondepartementales_id' => 'int',
		'directionregionales_id' => 'int',
		'jours_id' => 'int',
		'heures_id' => 'int',
		'classes_id' => 'int',
		'personnels_id' => 'int'
	];

	protected $fillable = [
		'id',
		'etablissementannees_id',
		'denominationetab',
		'libelleanneescolaire',
		'directiondepartementales_id',
		'denominationdd',
		'directionregionales_id',
		'denominationdr',
		'jours_id',
		'libellejours',
		'heures_id',
		'libelleheures',
		'classes_id',
		'denominationclasse',
		'personnels_id',
		'nom',
		'prenoms'
	];
}
