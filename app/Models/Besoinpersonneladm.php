<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Besoinpersonneladm
 * 
 * @property int $id
 * @property string|null $nombre
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $etablissementannees_id
 * @property int $fonctionpersonnels_id
 *
 * @package App\Models
 */
class Besoinpersonneladm extends Model
{
	protected $table = 'besoinpersonneladm';

	protected $casts = [
		'etablissementannees_id' => 'int',
		'fonctionpersonnels_id' => 'int'
	];

	protected $fillable = [
		'nombre',
		'etablissementannees_id',
		'fonctionpersonnels_id'
	];
}
