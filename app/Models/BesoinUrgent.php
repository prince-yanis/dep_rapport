<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BesoinUrgent
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property string|null $libellebesoin
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class BesoinUrgent extends Model
{
	protected $table = 'besoin_urgents';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'etablissementannees_id' => 'int'
	];

	protected $fillable = [
		'id',
		'etablissementannees_id',
		'libellebesoin'
	];

	public function amenagement()
	{
		return $this->hasMany(Amenagement::class, 'besoin_urgents_id');
	}
}
