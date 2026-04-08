<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Infrastructure
 * 
 * @property int $id
 * @property string|null $nombre
 * @property string|null $nombrebureaux
 * @property string|null $capacite
 * @property string|null $observation
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $etablissementannees_id
 * @property int $nbrefonctionnel
 * @property int $nbrenonfonctionel
 * @property int $designationinfrastructures_id
 *
 * @package App\Models
 */
class Infrastructure extends Model
{
	protected $table = 'infrastructures';

	protected $casts = [
		'etablissementannees_id' => 'int',
		'designationinfrastructures_id' => 'int'
	];

	protected $fillable = [
		'nbrefonctionnel',
		'nbrenonfonctionel',
		'nombre',
		'nombrebureaux',
		'capacite',
		'observation',
		'etablissementannees_id',
		'designationinfrastructures_id'
	];
}
