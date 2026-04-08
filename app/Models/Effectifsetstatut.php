<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Effectifsetstatut
 * 
 * @property int $id
 * @property int|null $nbretotal
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $observations
 * @property int $resultatsmission_id
 * 
 * @property Resultatsmission $resultatsmission
 *
 * @package App\Models
 */
class Effectifsetstatut extends Model
{
	protected $table = 'effectifsetstatut';

	protected $casts = [
		'nbretotal' => 'int',
		'resultatsmission_id' => 'int'
	];

	protected $fillable = [
		'nbretotal',
		'observations',
		'resultatsmission_id'
	];

	public function resultatsmission()
	{
		return $this->belongsTo(Resultatsmission::class);
	}

	public function detailseffectifsetstatut()
	{
		return $this->hasMany(Detailseffectifsetstatut::class);
	}
}
