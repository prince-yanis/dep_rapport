<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Besoinformation
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $etablissementannees_id
 * @property int $personnelannees_id
 * 
 * @property Personnelannee $personnelannee
 *
 * @package App\Models
 */
class Besoinformation extends Model
{
	protected $table = 'besoinformation';

	protected $casts = [
		'etablissementannees_id' => 'int',
		'personnelannees_id' => 'int'
	];

	protected $fillable = [
		'etablissementannees_id',
		'personnelannees_id'
	];

	public function personnelannee()
	{
		return $this->belongsTo(Personnelannee::class, 'personnelannees_id');
	}
}
