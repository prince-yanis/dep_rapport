<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiResponse
 * 
 * @property int $id
 * @property string $sender
 * @property string $code
 * @property string $data
 * @property string|null $date
 * @property string|null $time
 *
 * @package App\Models
 */
class ApiResponse extends Model
{
	protected $table = 'api_responses';
	public $timestamps = false;

	protected $casts = [

	];

	protected $fillable = [
		'sender',
		'code',
		'data',
		'date',
		'time'
	];
}
