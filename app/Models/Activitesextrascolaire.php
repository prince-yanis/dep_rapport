<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Activitesextrascolaire
 * 
 * @property int $id
 * @property string $nature
 * @property string|null $objectif
 * @property string|null $observation
 * @property int $etablissementannees_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Activitesextrascolaire extends Model
{
	protected $table = 'activitesextrascolaires';

	protected $casts = [
		'etablissementannees_id' => 'int'
	];

	protected $fillable = [
		'nature',
		'objectif',
		'observation',
		'etablissementannees_id'
	];

	public function etablissementannee()
	{
		return $this->belongsTo(Etablissementannee::class, 'etablissementannees_id');
	}
}
