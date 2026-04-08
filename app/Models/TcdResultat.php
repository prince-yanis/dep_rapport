<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TcdResultat
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property string|null $denominationetab
 * @property string|null $libelleanneescolaire
 * @property int|null $directiondepartementales_id
 * @property string|null $denominationdd
 * @property int|null $directionregionales_id
 * @property string|null $denominationdr
 * @property int $periodes_id
 * @property string|null $libelleperiode
 * @property int $apprenants_id
 * @property string|null $matriculeap
 * @property string|null $nom
 * @property string|null $prenoms
 * @property string|null $moyenneperiode
 * @property string|null $rangperiode
 * @property string|null $mentionperiode
 * @property string|null $observation
 *
 * @package App\Models
 */
class TcdResultat extends Model
{
	protected $table = 'tcd_resultat';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'etablissementannees_id' => 'int',
		'directiondepartementales_id' => 'int',
		'directionregionales_id' => 'int',
		'periodes_id' => 'int',
		'apprenants_id' => 'int'
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
		'periodes_id',
		'libelleperiode',
		'apprenants_id',
		'matriculeap',
		'nom',
		'prenoms',
		'moyenneperiode',
		'rangperiode',
		'mentionperiode',
		'observation'
	];
}
