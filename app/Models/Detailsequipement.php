<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Detailsequipement
 * 
 * @property int $id
 * @property int|null $nbrefonctionnel
 * @property int|null $nbrenonfonctionnel
 * @property int|null $nombre
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $equipements_id
 * @property int $rubriquecontrole_id
 * @property int $resultatstypesequipement_id
 * 
 * @property Equipement $equipement
 * @property Resultatstypesequipement $resultatstypesequipement
 * @property Rubriquecontrole $rubriquecontrole
 *
 * @package App\Models
 */
class Detailsequipement extends Model
{
	protected $table = 'detailsequipement';

	protected $casts = [
		'nbrefonctionnel' => 'int',
		'nbrenonfonctionnel' => 'int',
		'nombre' => 'int',
		'equipements_id' => 'int',
		'rubriquecontrole_id' => 'int',
		'resultatstypesequipement_id' => 'int'
	];

	protected $fillable = [
		'nbrefonctionnel',
		'nbrenonfonctionnel',
		'nombre',
		'equipements_id',
		'rubriquecontrole_id',
		'resultatstypesequipement_id'
	];

	public function equipement()
	{
		return $this->belongsTo(Equipement::class, 'equipements_id');
	}

	public function resultatstypesequipement()
	{
		return $this->belongsTo(Resultatstypesequipement::class);
	}

	public function rubriquecontrole()
	{
		return $this->belongsTo(Rubriquecontrole::class);
	}
}
