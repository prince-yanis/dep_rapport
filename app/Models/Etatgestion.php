<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Etatgestion
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property string $nature
 * @property string $difficultes
 * @property string $causes
 * @property string $suggestions
 * @property string $observations
 *
 * @package App\Models
 */
class Etatgestion extends Model
{
	protected $table = 'etatgestion';
	public $timestamps = false;

	protected $casts = [
		'etablissementannees_id' => 'int'
	];

	protected $fillable = [
		'etablissementannees_id',
		'nature',
		'difficultes',
		'causes',
		'suggestions',
		'observations'
	];
}
