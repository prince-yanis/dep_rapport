<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Equipement
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property int $materiels_id
 * @property int $nombre
 * @property int $nbrefonctionnel
 * @property int $nbrenonfonctionel
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Materiel $materiel
 *
 * @package App\Models
 */
class Equipement extends Model
{
	protected $table = 'equipements';

	protected $casts = [
		'etablissementannees_id' => 'int',
		'materiels_id' => 'int'
	];

	protected $fillable = [
		'etablissementannees_id',
		'materiels_id',
		'nbrefonctionnel',
		'nbrenonfonctionel',
		'nombre'
	];

	public function materiel()
	{
		return $this->belongsTo(Materiel::class, 'materiels_id');
	}
}
