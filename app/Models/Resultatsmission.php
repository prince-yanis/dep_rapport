<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Resultatsmission
 * 
 * @property int $id
 * @property string|null $observation
 * @property string|null $recommandation
 * @property string|null $periode_execution
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $mission_id
 * @property int $rubriquecontrole_id
 * 
 * @property Mission $mission
 * @property Rubriquecontrole $rubriquecontrole
 * @property Collection|Effectifsetstatut[] $effectifsetstatuts
 * @property Collection|Filiereautorise[] $filiereautorises
 * @property Collection|Resultatscontrole[] $resultatscontroles
 * @property Collection|Resultatsscolaire[] $resultatsscolaires
 * @property Collection|Resultatstypepersonnel[] $resultatstypepersonnels
 * @property Collection|Resultatstypesequipement[] $resultatstypesequipements
 *
 * @package App\Models
 */
class Resultatsmission extends Model
{
	protected $table = 'resultatsmission';

	protected $casts = [
		'mission_id' => 'int',
		'rubriquecontrole_id' => 'int'
	];

	protected $fillable = [
		'observation',
		'recommandation',
		'periode_execution',
		'mission_id',
		'rubriquecontrole_id'
	];

	public function mission()
	{
		return $this->belongsTo(Mission::class);
	}

	public function rubriquecontrole()
	{
		return $this->belongsTo(Rubriquecontrole::class);
	}

	public function effectifsetstatuts()
	{
		return $this->hasMany(Effectifsetstatut::class);
	}

	public function filiereautorises()
	{
		return $this->hasMany(Filiereautorise::class);
	}

	public function resultatscontroles()
	{
		return $this->hasMany(Resultatscontrole::class);
	}

	public function resultatsscolaires()
	{
		return $this->hasMany(Resultatsscolaire::class);
	}

	public function resultatstypepersonnels()
	{
		return $this->hasMany(Resultatstypepersonnel::class);
	}

	public function resultatstypesequipements()
	{
		return $this->hasMany(Resultatstypesequipement::class);
	}
}
