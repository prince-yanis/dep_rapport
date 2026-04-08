<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProblemeUrgent
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property string $libelleprobleme
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class ProblemeUrgent extends Model
{
	protected $table = 'probleme_urgent';

	protected $casts = [
		'etablissementannees_id' => 'int'
	];

	protected $fillable = [
		'etablissementannees_id',
		'libelleprobleme'
	];
}
