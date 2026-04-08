<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Bourse
 * 
 * @property int $id
 * @property string|null $libellebourse
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Bourse extends Model
{
	protected $table = 'bourses';

	protected $fillable = [
		'libellebourse'
	];
	public function apprenantannees()
	{
		return $this->hasMany(Apprenantannee::class, 'bourses_id');
	}
	
}
