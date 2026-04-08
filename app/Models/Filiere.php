<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Filiere
 * 
 * @property int $id
 * @property string|null $libellefiliere
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $ordre_enseignement_id

 *
 * @package App\Models
 */
class Filiere extends Model
{
	protected $table = 'filieres';

	protected $casts = [
		'ordre_enseignement_id' => 'int'
	];

	protected $fillable = [
		'libellefiliere',
		'ordre_enseignement_id'
	];
	public function apprenantannees()
	{
		return $this->hasMany(Apprenantannee::class, 'filieres_id');
	}
}
