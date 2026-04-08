<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Besoin
 * 
 * @property int $id
 * @property string|null $quantite
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $etablissementannees_id
 * @property int $materiels_id
 *
 * @package App\Models
 */
class Besoin extends Model
{
	protected $table = 'besoin';

	protected $casts = [
		'etablissementannees_id' => 'int',
		'materiels_id' => 'int'
	];

	protected $fillable = [
		'quantite',
		'etablissementannees_id',
		'materiels_id'
	];
}
