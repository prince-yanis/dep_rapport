<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Departement
 * 
 * @property int $id
 * @property int $regions_id
 * @property string|null $denominationdepartement
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Departement extends Model
{
	protected $table = 'departements';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'regions_id' => 'int'
	];

	protected $fillable = [
		'regions_id',
		'denominationdepartement'
	];
}
