<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Periode
 * 
 * @property int $id
 * @property string|null $libelleperiode
 * @property string|null $coefficientperiode
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $typeperiodes_id
 *
 * @package App\Models
 */
class Periode extends Model
{
	protected $table = 'periodes';

	protected $casts = [
		'typeperiodes_id' => 'int'
	];

	protected $fillable = [
		'libelleperiode',
		'coefficientperiode',
		'typeperiodes_id'
	];
}
