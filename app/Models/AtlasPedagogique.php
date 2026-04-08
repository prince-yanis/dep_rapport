<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AtlasPedagogique
 * 
 * @property int $id_etab
 * @property string|null $denominationetab
 * @property int|null $directiondepartementales_id
 * @property string|null $denominationdd
 * @property int|null $directionregionales_id
 * @property string|null $denominationdr
 *
 * @package App\Models
 */
class AtlasPedagogique extends Model
{
	protected $table = 'atlas_pedagogique';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_etab' => 'int',
		'directiondepartementales_id' => 'int',
		'directionregionales_id' => 'int'
	];

	protected $fillable = [
		'id_etab',
		'denominationetab',
		'directiondepartementales_id',
		'denominationdd',
		'directionregionales_id',
		'denominationdr'
	];
}
