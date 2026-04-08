<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProblemeInfrastructure
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property string|null $libelleprobleme
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class ProblemeInfrastructure extends Model
{
	protected $table = 'probleme_infrastructures';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'etablissementannees_id' => 'int'
	];

	protected $fillable = [
		'id',
		'etablissementannees_id',
		'libelleprobleme'
	];
}
