<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Resultat
 * 
 * @property int $id
 * @property string|null $moyenneperiode
 * @property string|null $rangperiode
 * @property string|null $mentionperiode
 * @property string|null $observation
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $etablissementannees_id
 * @property int $periodes_id
 * @property int $apprenants_id
 *
 * @package App\Models
 */
class Resultat extends Model
{
	protected $table = 'resultats';

	protected $casts = [
		'etablissementannees_id' => 'int',
		'apprenants_id' => 'int'
	];

	protected $fillable = [
		'moyenneperiode',
		'rangperiode',
		'mentionperiode',
		'observation',
		'etablissementannees_id',
		'apprenants_id'
	];
}
