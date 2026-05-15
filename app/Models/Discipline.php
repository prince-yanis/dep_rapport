<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Discipline
 * 
 * @property int $id
 * @property string|null $libellediscipline
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Discipline extends Model
{
	protected $table = 'disciplines';

	protected $fillable = [
		'libellediscipline'
	];
	
	public function besoinpersonnelens()
	{
		return $this->hasMany(Besoinpersonnelen::class, 'disciplines_id');
	}
}
