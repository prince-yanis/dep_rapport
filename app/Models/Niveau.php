<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Niveau
 * 
 * @property int $id
 * @property string|null $libelleniveau
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Niveau extends Model
{
	protected $table = 'niveau';

	protected $fillable = [
		'libelleniveau'
	];
	public function apprenantannees()
	{
		return $this->hasMany(Apprenantannee::class, 'niveau_id');
	}
}
