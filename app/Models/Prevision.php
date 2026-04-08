<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Prevision
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property string $libelleprevision
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Prevision extends Model
{
	protected $table = 'previsions';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'etablissementannees_id' => 'int'
	];

	protected $fillable = [
		'etablissementannees_id',
		'libelleprevision'
	];
}
