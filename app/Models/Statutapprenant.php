<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Statutapprenant
 * 
 * @property int $id
 * @property string|null $libellestatutap
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Statutapprenant extends Model
{
	protected $table = 'statutapprenants';

	protected $fillable = [
		'libellestatutap'
	];
	public function apprenantannees()
	{
		return $this->hasMany(Apprenantannee::class, 'statutapprenants_id');
	}
}
