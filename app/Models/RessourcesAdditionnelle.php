<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RessourcesAdditionnelle
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property string|null $banque
 * @property string|null $numero_compte
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class RessourcesAdditionnelle extends Model
{
	protected $table = 'ressources_additionnelles';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'etablissementannees_id' => 'int'
	];

	protected $fillable = [
		'id',
		'etablissementannees_id',
		'banque',
		'numero_compte'
	];
}
