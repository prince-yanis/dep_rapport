<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Designationinfrastructure
 * 
 * @property int $id
 * @property string|null $libelleinfrastructure
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Designationinfrastructure extends Model
{
	protected $table = 'designationinfrastructures';

	protected $fillable = [
		'libelleinfrastructure'
	];
}
