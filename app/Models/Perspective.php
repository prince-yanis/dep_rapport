<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Perspective
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property string|null $libelleperspective
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Perspective extends Model
{
	protected $table = 'perspectives';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'etablissementannees_id' => 'int'
	];

	protected $fillable = [
		'id',
		'etablissementannees_id',
		'libelleperspective'
	];
}
