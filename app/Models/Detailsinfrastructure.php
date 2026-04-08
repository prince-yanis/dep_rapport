<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Detailsinfrastructure
 * 
 * @property int $id
 * @property int|null $nbrefonctionnel
 * @property int|null $nbrenonfonctionnel
 * @property int|null $nombre
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $infrastructures_id
 * @property int $rubriquecontrole_id
 * @property int $resultatstypesequipement_id
 * 
 * @property Infrastructure $infrastructure
 * @property Resultatstypesequipement $resultatstypesequipement
 * @property Rubriquecontrole $rubriquecontrole
 * @property Collection|Resultatstypesequipement[] $resultatstypesequipements
 *
 * @package App\Models
 */
class Detailsinfrastructure extends Model
{
	protected $table = 'detailsinfrastructure';

	protected $casts = [
		'nbrefonctionnel' => 'int',
		'nbrenonfonctionnel' => 'int',
		'nombre' => 'int',
		'infrastructures_id' => 'int',
		'rubriquecontrole_id' => 'int',
		'resultatstypesequipement_id' => 'int'
	];

	protected $fillable = [
		'nbrefonctionnel',
		'nbrenonfonctionnel',
		'nombre',
		'infrastructures_id',
		'rubriquecontrole_id',
		'resultatstypesequipement_id'
	];

	public function infrastructure()
	{
		return $this->belongsTo(Infrastructure::class, 'infrastructures_id');
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
