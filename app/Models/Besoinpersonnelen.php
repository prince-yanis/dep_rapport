<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Besoinpersonnelen
 * 
 * @property int $id
 * @property string|null $nombre
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $disciplines_id
 * @property int $etablissementannees_id
 * @property int $niveauenseignant_id
 *
 * @package App\Models
 */
class Besoinpersonnelen extends Model
{
	protected $table = 'besoinpersonnelens';

	protected $casts = [
		'disciplines_id' => 'int',
		'etablissementannees_id' => 'int',
		'niveauenseignant_id' => 'int'
	];

	protected $fillable = [
		'nombre',
		'disciplines_id',
		'etablissementannees_id',
		'niveauenseignant_id'
	];
}
