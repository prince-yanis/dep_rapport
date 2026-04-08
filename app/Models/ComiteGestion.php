<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ComiteGestion
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property string|null $nomprenoms
 * @property Carbon|null $updated_at
 * @property Carbon|null $created_at
 * @property int $membre_comites_id
 *
 * @package App\Models
 */
class ComiteGestion extends Model
{
	protected $table = 'comite_gestions';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'etablissementannees_id' => 'int',
		'membre_comites_id' => 'int'
	];

	protected $fillable = [
		'id',
		'etablissementannees_id',
		'nomprenoms',
		'membre_comites_id'
	];
}
