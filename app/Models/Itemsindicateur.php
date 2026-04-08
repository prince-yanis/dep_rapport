<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Itemsindicateur
 * 
 * @property int $id
 * @property string|null $libelleitems
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Itemsindicateur extends Model
{
	protected $table = 'itemsindicateurs';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'id',
		'libelleitems'
	];
}
