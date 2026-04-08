<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Commune
 * 
 * @property int $id
 * @property int|null $departements_id
 * @property string|null $denominationcommune
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Commune extends Model
{
	protected $table = 'communes';

	protected $casts = [
		'departements_id' => 'int'
	];

	protected $fillable = [
		'departements_id',
		'denominationcommune'
	];
}
