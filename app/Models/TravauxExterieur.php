<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TravauxExterieur
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property string|null $nature
 * @property string|null $client
 * @property int|null $montant_previsionnel
 * @property int|null $part_etab
 * @property int|null $part_fonds
 * @property string|null $observations
 * @property Carbon|null $updated_at
 * @property Carbon|null $created_at
 *
 * @package App\Models
 */
class TravauxExterieur extends Model
{
	protected $table = 'travaux_exterieurs';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'etablissementannees_id' => 'int',
		'montant_previsionnel' => 'int',
		'part_etab' => 'int',
		'part_fonds' => 'int'
	];

	protected $fillable = [
		'id',
		'etablissementannees_id',
		'nature',
		'client',
		'montant_previsionnel',
		'part_etab',
		'part_fonds',
		'observations'
	];
}
