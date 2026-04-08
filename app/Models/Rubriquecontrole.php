<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Rubriquecontrole
 * 
 * @property int $id
 * @property string|null $libellerubrique
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Detailsequipement[] $detailsequipements
 * @property Collection|Detailsinfrastructure[] $detailsinfrastructures
 * @property Collection|Resultatsmission[] $resultatsmissions
 * @property Collection|Sousrubriquecontrole[] $sousrubriquecontroles
 *
 * @package App\Models
 */
class Rubriquecontrole extends Model
{
	protected $table = 'rubriquecontrole';

	protected $fillable = [
		'libellerubrique'
	];

	public function detailsequipements()
	{
		return $this->hasMany(Detailsequipement::class);
	}

	public function detailsinfrastructures()
	{
		return $this->hasMany(Detailsinfrastructure::class);
	}

	public function resultatsmissions()
	{
		return $this->hasMany(Resultatsmission::class);
	}

	public function sousrubriquecontroles()
	{
		return $this->hasMany(Sousrubriquecontrole::class);
	}
}
