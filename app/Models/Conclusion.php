<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Conclusion
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property string|null $libelleconclusion
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Conclusion extends Model
{
	protected $table = 'conclusion';

	protected $casts = [
		'etablissementannees_id' => 'int'
	];

	protected $fillable = [
		'etablissementannees_id',
		'libelleconclusion'
	];
}
