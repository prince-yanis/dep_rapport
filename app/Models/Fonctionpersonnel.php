<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Fonctionpersonnel
 * 
 * @property int $id
 * @property int $typepersonnels_id
 * @property string|null $libellefonction
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Fonctionpersonnel extends Model
{
	protected $table = 'fonctionpersonnels';

	protected $casts = [
		'typepersonnels_id' => 'int'
	];

	protected $fillable = [
		'libellefonction',
		'typepersonnels_id'
	];

}
