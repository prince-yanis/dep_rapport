<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Besoinpersonnelen
 * 
 * @property int $id
 * @property string|null $nombre
 * @property int|null $nombre_existant
 * @property int|null $nombre_necessaire
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $disciplines_id
 * @property int $etablissementannees_id
 * @property int $niveauenseignant_id
 * @property string|null $observation
 *
 * @package App\Models
 */
class Besoinpersonnelen extends Model
{
	protected $table = 'besoinpersonnelens';

	protected $casts = [
		'nombre_existant' => 'int',
		'nombre_necessaire' => 'int',
		'disciplines_id' => 'int',
		'etablissementannees_id' => 'int',
		'niveauenseignant_id' => 'int'
	];

	protected $fillable = [
		'nombre',
		'nombre_existant',
		'nombre_necessaire',
		'disciplines_id',
		'etablissementannees_id',
		'niveauenseignant_id',
		'observation'
	];
	
	public function etablissementannee()
	{
		return $this->belongsTo(Etablissementannee::class, 'etablissementannees_id');
	}
	
	public function discipline()
	{
		return $this->belongsTo(Discipline::class, 'disciplines_id');
	}
	
	public function niveauenseignant()
	{
		return $this->belongsTo(Niveauenseignant::class, 'niveauenseignant_id');
	}
}
