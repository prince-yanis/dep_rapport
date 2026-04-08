<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Anneescolairesperiode
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $periodes_id
 * @property int $anneescolaires_id
 *
 * @package App\Models
 */
class Anneescolairesperiode extends Model
{
	protected $table = 'anneescolairesperiodes';

	protected $casts = [
		'periodes_id' => 'int',
		'anneescolaires_id' => 'int'
	];

	protected $fillable = [
		'periodes_id',
		'anneescolaires_id'
	];
}
