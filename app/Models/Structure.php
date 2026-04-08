<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Structure
 * 
 * @property int $id
 * @property string|null $libellestructure
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Superviseur[] $superviseurs
 *
 * @package App\Models
 */
class Structure extends Model
{
	protected $table = 'structure';

	protected $fillable = [
		'libellestructure'
	];

	public function superviseurs()
	{
		return $this->hasMany(Superviseur::class);
	}
}
