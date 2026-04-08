<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Recapgeneral
 * 
 * @property int|null $etablissementannees_id
 * @property int|null $etablissement_ordre_id
 * @property string|null $etablissement_ordre
 * @property int|null $anneescolaires_id
 * @property int|null $etablissements_id
 * @property string|null $libelleniveau
 * @property float|null $CAP
 * @property float|null $BEP
 * @property float|null $BT
 * @property float|null $BAC
 *
 * @package App\Models
 */
class Recapgeneral extends Model
{
	protected $table = 'recapgeneral';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'etablissementannees_id' => 'int',
		'etablissement_ordre_id' => 'int',
		'anneescolaires_id' => 'int',
		'etablissements_id' => 'int',
		'CAP' => 'float',
		'BEP' => 'float',
		'BT' => 'float',
		'BAC' => 'float'
	];

	protected $fillable = [
		'etablissementannees_id',
		'etablissement_ordre_id',
		'etablissement_ordre',
		'anneescolaires_id',
		'etablissements_id',
		'libelleniveau',
		'CAP',
		'BEP',
		'BT',
		'BAC'
	];
}
