<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Amenagement
 * 
 * @property int $id
 * @property string|null $designation
 * @property int|null $existant
 * @property int|null $besoin
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $besoin_urgents_id
 *
 * @package App\Models
 */
class Amenagement extends Model
{
	protected $table = 'amenagements';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'existant' => 'int',
		'besoin' => 'int',
		'besoin_urgents_id' => 'int'
	];

	protected $fillable = [
		'id',
		'designation',
		'existant',
		'besoin',
		'besoin_urgents_id'
	];
}
