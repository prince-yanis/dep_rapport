<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Equipement
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property string|null $existe_materiel
 * @property Carbon|null $date_materiel
 * @property string|null $programme
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property string|null $existe_equipement
 * @property Carbon|null $date_equipement
 *
 * @package App\Models
 */
class Equipement extends Model
{
	protected $table = 'equipements';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'etablissementannees_id' => 'int'
	];

	protected $dates = [
		'date_materiel',
		'date_equipement'
	];

	protected $fillable = [
		'id',
		'etablissementannees_id',
		'existe_materiel',
		'date_materiel',
		'programme',
		'existe_equipement',
		'date_equipement'
	];
}
