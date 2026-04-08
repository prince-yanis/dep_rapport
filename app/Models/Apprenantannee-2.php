<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Apprenantannee
 * 
 * @property int $id
 * @property string $moyenne1er
 * @property string $moyenne2eme
 * @property string|null $moyenneannee
 * @property string|null $observation
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $classes_id
 * @property int $apprenants_id
 * @property int $etablissementannees_id
 * @property int $statutapprenants_id
 * @property int $bourses_id
 * @property int|null $groupepedagogiques_id
 * @property int $decision_id
 *
 * @package App\Models
 */
class Apprenantannee extends Model
{
	protected $table = 'apprenantannees';

	protected $casts = [
		'classes_id' => 'int',
		'apprenants_id' => 'int',
		'etablissementannees_id' => 'int',
		'statutapprenants_id' => 'int',
		'bourses_id' => 'int',
		'groupepedagogiques_id' => 'int',
		'decision_id' => 'int'
	];

	protected $fillable = [
		'moyenne1er',
		'moyenne2eme',
		'moyenneannee',
		'observation',
		'classes_id',
		'apprenants_id',
		'etablissementannees_id',
		'statutapprenants_id',
		'bourses_id',
		'groupepedagogiques_id',
		'decision_id'
	];
}
