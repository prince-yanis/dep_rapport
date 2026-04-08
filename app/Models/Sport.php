<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sport
 * 
 * @property int $id
 * @property string|null $libellesport
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Sport extends Model
{
	protected $table = 'sport';

	protected $fillable = [
		'libellesport'
	];
}
