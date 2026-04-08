<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Periodesannuelle
 * 
 * @property int $id
 * @property string $libelleperiode
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Periodesannuelle extends Model
{
	protected $table = 'periodesannuelle';

	protected $fillable = [
		'libelleperiode'
	];
}
