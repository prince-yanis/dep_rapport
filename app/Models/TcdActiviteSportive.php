<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TcdActiviteSportive
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property int $sport_id
 * @property string|null $libellesport
 * @property string|null $denominationetab
 * @property string|null $libelleanneescolaire
 * @property int|null $directiondepartementales_id
 * @property string|null $denominationdd
 * @property int|null $directionregionales_id
 * @property string|null $denominationdr
 *
 * @package App\Models
 */
class TcdActiviteSportive extends Model
{
	protected $table = 'tcd_activite_sportive';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'etablissementannees_id' => 'int',
		'sport_id' => 'int',
		'directiondepartementales_id' => 'int',
		'directionregionales_id' => 'int'
	];

	protected $fillable = [
		'id',
		'etablissementannees_id',
		'sport_id',
		'libellesport',
		'denominationetab',
		'libelleanneescolaire',
		'directiondepartementales_id',
		'denominationdd',
		'directionregionales_id',
		'denominationdr'
	];
}
