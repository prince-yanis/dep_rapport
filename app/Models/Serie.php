<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Serie
 * 
 * @property int $id
 * @property string|null $libelleserie
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Serie extends Model
{
	protected $table = 'serie';

	protected $fillable = [
		'libelleserie'
	];
}
