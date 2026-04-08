<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrdreEnseignement
 * 
 * @property int $id
 * @property string $libelleenseignement
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class OrdreEnseignement extends Model
{
	protected $table = 'ordre_enseignement';

	protected $casts = [
		'libelleenseignement' => 'string'
	];

	protected $fillable = [
		'libelleenseignement'
	];
}
