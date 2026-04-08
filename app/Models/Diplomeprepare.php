<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Diplomeprepare
 * 
 * @property int $id
 * @property string|null $libellediplome
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Diplomeprepare extends Model
{
	protected $table = 'diplomeprepares';

	protected $fillable = [
		'libellediplome'
	];
	public function apprenantannees()
	{
		return $this->hasMany(Apprenantannee::class, 'diplomeprepares_id');
	}
}
