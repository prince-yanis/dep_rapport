<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TcdBesoinPersonnelEn
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property string|null $denominationetab
 * @property string|null $libelleanneescolaire
 * @property int|null $directiondepartementales_id
 * @property string|null $denominationdd
 * @property int|null $directionregionales_id
 * @property string|null $denominationdr
 * @property int $disciplines_id
 * @property string|null $libellediscipline
 * @property int $niveauenseignant_id
 * @property string|null $libelleniveau
 * @property string|null $nombre
 *
 * @package App\Models
 */
class TcdBesoinPersonnelEn extends Model
{
	protected $table = 'tcd_besoin_personnel_ens';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'etablissementannees_id' => 'int',
		'directiondepartementales_id' => 'int',
		'directionregionales_id' => 'int',
		'disciplines_id' => 'int',
		'niveauenseignant_id' => 'int'
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
		'disciplines_id',
		'libellediscipline',
		'niveauenseignant_id',
		'libelleniveau',
		'nombre'
	];
}
