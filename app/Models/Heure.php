<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Heure
 * 
 * @property int $id
 * @property string|null $libelleheures
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Planning[] $plannings
 *
 * @package App\Models
 */
class Heure extends Model
{
	protected $table = 'heures';

	protected $fillable = [
		'libelleheures'
	];

	public function plannings()
	{
		return $this->hasMany(Planning::class, 'heures_id');
	}
}
