<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Unitepedagogique
 * 
 * @property int $id
 * @property string|null $designationup
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $disciplines_id
 *
 * @package App\Models
 */
class Unitepedagogique extends Model
{
	protected $table = 'unitepedagogiques';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'disciplines_id' => 'int'
	];

	protected $fillable = [
		'id',
		'designationup',
		'disciplines_id'
	];
}
