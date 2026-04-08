<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Decision
 * 
 * @property int $id
 * @property string $libelledecision
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Decision extends Model
{
	protected $table = 'decision';

	protected $fillable = [
		'libelledecision'
	];
	public function apprenantannees()
	{
		return $this->hasMany(Apprenantannee::class, 'decision_id');
	}
}
