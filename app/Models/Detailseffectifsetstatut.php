<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Detailseffectifsetstatut
 * 
 * @property int $id
 * @property int|null $nbreaffecte
 * @property int|null $nbrenonaffecte
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $niveau_id
 * @property int $ordre_enseignement_id
 * @property int $resultatscontrole_id
 * 
 * @property Niveau $niveau
 * @property OrdreEnseignement $ordre_enseignement
 * @property Resultatscontrole $resultatscontrole
 *
 * @package App\Models
 */
class Detailseffectifsetstatut extends Model
{
	protected $table = 'detailseffectifsetstatut';

	protected $casts = [
		'nbreaffecte' => 'int',
		'nbrenonaffecte' => 'int',
		'niveau_id' => 'int',
		'ordre_enseignement_id' => 'int',
		'resultatscontrole_id' => 'int'
	];

	protected $fillable = [
		'nbreaffecte',
		'nbrenonaffecte',
		'niveau_id',
		'resultatscontrole_id'
	];

	public function niveau()
	{
		return $this->belongsTo(Niveau::class);
	}

	public function ordre_enseignement()
	{
		return $this->belongsTo(OrdreEnseignement::class);
	}
	public function effectifsetstatut()
	{
		return $this->belongsTo(Effectifsetstatut::class);
	}
}
