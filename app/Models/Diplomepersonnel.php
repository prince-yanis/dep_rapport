<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Diplomepersonnel
 * 
 * @property int $id
 * @property string|null $libellediplome
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Diplomepersonnel extends Model
{
	protected $table = 'diplomepersonnels';

	protected $fillable = [
		'libellediplome'
	];
}
