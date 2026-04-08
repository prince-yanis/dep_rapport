<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TcdClasse
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property string|null $denominationetab
 * @property string|null $libelleanneescolaire
 * @property int|null $directiondepartementales_id
 * @property string|null $denominationdd
 * @property int|null $directionregionales_id
 * @property string|null $denominationdr
 * @property int $groupepedagogiques_id
 * @property string|null $libellegp
 * @property string|null $denominationclasse
 *
 * @package App\Models
 */
class TcdClasse extends Model
{
	protected $table = 'tcd_classe';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'etablissementannees_id' => 'int',
		'directiondepartementales_id' => 'int',
		'directionregionales_id' => 'int',
		'groupepedagogiques_id' => 'int'
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
		'groupepedagogiques_id',
		'libellegp',
		'denominationclasse'
	];
}
