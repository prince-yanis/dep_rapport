<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PointExecution
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $etablissementannees_id
 * @property int $total_chapitre
 * @property int $chapitres_execute
 * @property int|null $total_lecon
 * @property int|null $lecons_execute
 * @property int $disciplines_id
 * @property float|null $pourcentage_chapitre
 * @property float|null $pourcentage_lecon
 * @property string|null $observations
 *
 * @package App\Models
 */
class PointExecution extends Model
{
	protected $table = 'point_executions';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'etablissementannees_id' => 'int',
		'total_chapitre' => 'int',
		'chapitres_execute' => 'int',
		'total_lecon' => 'int',
		'lecons_execute' => 'int',
		'disciplines_id' => 'int',
		'pourcentage_chapitre' => 'float',
		'pourcentage_lecon' => 'float'
	];

	protected $fillable = [
		'id',
		'etablissementannees_id',
		'total_chapitre',
		'chapitres_execute',
		'total_lecon',
		'lecons_execute',
		'disciplines_id',
		'pourcentage_chapitre',
		'pourcentage_lecon',
		'observations'
	];
}
