<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Demarrageannee
 * 
 * @property int $id
 * @property int|null $nouvelan
 * @property int|null $anpreccedent
 *
 * @package App\Models
 */
class Demarrageannee extends Model
{
	protected $table = 'demarrageannee';
	public $timestamps = false;

	protected $casts = [
		'nouvelan' => 'int',
		'anpreccedent' => 'int'
	];

	protected $fillable = [
		'nouvelan',
		'anpreccedent'
	];
}
