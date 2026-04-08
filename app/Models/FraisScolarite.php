<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FraisScolarite
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property string|null $nature
 * @property string|null $nombre_eleve
 * @property int|null $total_percus
 * @property int|null $part_etab
 * @property int|null $part_fonds
 * @property string|null $observations
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class FraisScolarite extends Model
{
	protected $table = 'frais_scolarites';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'etablissementannees_id' => 'int',
		'total_percus' => 'int',
		'part_etab' => 'int',
		'part_fonds' => 'int'
	];

	protected $fillable = [
		'id',
		'etablissementannees_id',
		'nature',
		'nombre_eleve',
		'total_percus',
		'part_etab',
		'part_fonds',
		'observations'
	];
}
