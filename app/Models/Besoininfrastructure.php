<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Besoininfrastructure
 * 
 * @property int $id
 * @property string|null $quantite
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $etablissementannees_id
 * @property int $designationinfrastructures_id
 *
 * @package App\Models
 */
class Besoininfrastructure extends Model
{
	protected $table = 'besoininfrastructures';

	protected $casts = [
		'etablissementannees_id' => 'int',
		'designationinfrastructures_id' => 'int'
	];

	protected $fillable = [
		'quantite',
		'etablissementannees_id',
		'designationinfrastructures_id'
	];
}
