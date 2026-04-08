<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Activitesportive
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $etablissementannees_id
 * @property int $sport_id
 *
 * @package App\Models
 */
class Activitesportive extends Model
{
	protected $table = 'activitesportive';

	protected $casts = [
		'etablissementannees_id' => 'int',
		'sport_id' => 'int'
	];

	protected $fillable = [
		'etablissementannees_id',
		'sport_id'
	];
}
