<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Statutpersonnel
 * 
 * @property int $id
 * @property string|null $libellestatutpers
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Statutpersonnel extends Model
{
	protected $table = 'statutpersonnel';

	protected $fillable = [
		'libellestatutpers'
	];
}
