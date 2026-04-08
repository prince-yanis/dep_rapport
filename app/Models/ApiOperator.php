<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiOperator
 * 
 * @property int $id
 * @property string $name
 * @property string $api_code
 * @property string|null $api_pass
 * @property string|null $mobile
 * @property string|null $email
 *
 * @package App\Models
 */
class ApiOperator extends Model
{
	protected $table = 'api_operators';
	public $timestamps = false;

	protected $casts = [

	];

	protected $fillable = [
		'name',
		'api_code',
		'api_pass',
		'mobile',
		'email'
	];
}
