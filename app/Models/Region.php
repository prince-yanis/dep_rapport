<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Region
 * 
 * @property int $id
 * @property int $districts_id
 * @property string|null $denominationregion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Region extends Model
{
	protected $table = 'regions';

	protected $casts = [
		'districts_id' => 'int'
	];

	protected $fillable = [
		'districts_id',
		'denominationregion'
	];
}
