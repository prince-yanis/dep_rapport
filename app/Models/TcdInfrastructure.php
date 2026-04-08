<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TcdInfrastructure
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property string|null $denominationetab
 * @property string|null $libelleanneescolaire
 * @property int|null $directiondepartementales_id
 * @property string|null $denominationdd
 * @property int|null $directionregionales_id
 * @property string|null $denominationdr
 * @property int $designationinfrastructures_id
 * @property string|null $libelleinfrastructure
 * @property string|null $nombre
 * @property string|null $nombrebureaux
 * @property string|null $capacite
 * @property string|null $observation
 *
 * @package App\Models
 */
class TcdInfrastructure extends Model
{
	protected $table = 'tcd_infrastructure';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'etablissementannees_id' => 'int',
		'directiondepartementales_id' => 'int',
		'directionregionales_id' => 'int',
		'designationinfrastructures_id' => 'int'
	];

	protected $fillable = [
		'id',
		'etablissementannees_id',
		'denominationetab',
		'libelleanneescolaire',
		'directiondepartementales_id',
		'denominationdd',
		'directionregionales_id',
		'denominationdr',
		'designationinfrastructures_id',
		'libelleinfrastructure',
		'nombre',
		'nombrebureaux',
		'capacite',
		'observation'
	];
}
