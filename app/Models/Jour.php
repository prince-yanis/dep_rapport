<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Jour
 * 
 * @property int $id
 * @property string|null $libellejours
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Planning[] $plannings
 *
 * @package App\Models
 */
class Jour extends Model
{
	protected $table = 'jours';

	protected $fillable = [
		'libellejours'
	];

	public function plannings()
	{
		return $this->hasMany(Planning::class, 'jours_id');
	}
}
