<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Directiondepartementale
 * 
 * @property int $id
 * @property int $directionregionales_id
 * @property string|null $denominationdd
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Directiondepartementale extends Model
{
	protected $table = 'directiondepartementales';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'directionregionales_id' => 'int'
	];

	protected $fillable = [
		'directionregionales_id',
		'denominationdd'
	];
}
