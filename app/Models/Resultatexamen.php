<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Resultatexamen
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property int $diplomeprepares_id
 * @property int $filieres_id
 * @property string $nombrecandidat_f
 * @property string $nombrecandidat_g
 * @property string $nombrecandidat_t
 * @property string $nombreadmis_f
 * @property string $nombreadmis_g
 * @property string $nombreadmis_t
 * @property string $observations
 *
 * @package App\Models
 */
class Resultatexamen extends Model
{
	protected $table = 'resultatexamens';
	public $timestamps = false;

	protected $casts = [
		'etablissementannees_id' => 'int',
		'diplomeprepares_id' => 'int',
		'filieres_id' => 'int'
	];

	protected $fillable = [
		'etablissementannees_id',
		'diplomeprepares_id',
		'filieres_id',
		'nombrecandidat_f',
		'nombrecandidat_g',
		'nombrecandidat_t',
		'nombreadmis_f',
		'nombreadmis_g',
		'nombreadmis_t',
		'observations'
	];
}
