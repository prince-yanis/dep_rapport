<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Typepersonnel
 * 
 * @property int $id
 * @property string|null $libelletypepersonnel
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Typepersonnel extends Model
{
	protected $table = 'typepersonnels';

	protected $fillable = [
		'libelletypepersonnel'
	];
}
