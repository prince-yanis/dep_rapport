<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Typeperiode
 * 
 * @property int $id
 * @property string|null $libelletypeperiode
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Typeperiode extends Model
{
	protected $table = 'typeperiodes';

	protected $fillable = [
		'libelletypeperiode'
	];
}
