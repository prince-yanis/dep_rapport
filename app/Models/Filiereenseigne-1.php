<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Filiereenseigne
 * 
 * @property int $id
 * @property string|null $dureeformation
 * @property string|null $observation
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $filieres_id
 * @property int $etablissementannees_id
 *
 * @package App\Models
 */
class Filiereenseigne extends Model
{
	protected $table = 'filiereenseignes';

	protected $casts = [
		'filieres_id' => 'int',
		'etablissementannees_id' => 'int'
	];

	protected $fillable = [
		'dureeformation',
		'observation',
		'filieres_id',
		'etablissementannees_id'
	];
}
