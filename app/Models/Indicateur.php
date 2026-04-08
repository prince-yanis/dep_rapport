<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Indicateur
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $etablissementannees_id
 * @property int $tauxobtenu_n1
 * @property int $tauxcible
 * @property int|null $itemsindicateurs_id
 *
 * @package App\Models
 */
class Indicateur extends Model
{
	protected $table = 'indicateurs';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'etablissementannees_id' => 'int',
		'tauxobtenu_n1' => 'int',
		'tauxcible' => 'int',
		'itemsindicateurs_id' => 'int'
	];

	protected $fillable = [
		'id',
		'etablissementannees_id',
		'tauxobtenu_n1',
		'tauxcible',
		'itemsindicateurs_id'
	];
}
