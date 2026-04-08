<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Resultatscontrole
 * 
 * @property int $id
 * @property string|null $observationpartielles
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $resultatsmission_id
 * @property int $sousrubriquecontrole_id
 * 
 * @property Resultatsmission $resultatsmission
 * @property Sousrubriquecontrole $sousrubriquecontrole
 * @property Collection|Detailsresultatscontrole[] $detailsresultatscontroles
 *
 * @package App\Models
 */
class Resultatscontrole extends Model
{
	protected $table = 'resultatscontrole';

	protected $casts = [
		'resultatsmission_id' => 'int',
		'sousrubriquecontrole_id' => 'int'
	];

	protected $fillable = [
		'observationpartielles',
		'resultatsmission_id',
		'sousrubriquecontrole_id'
	];

	public function resultatsmission()
	{
		return $this->belongsTo(Resultatsmission::class);
	}

	public function sousrubriquecontrole()
	{
		return $this->belongsTo(Sousrubriquecontrole::class);
	}

	public function detailsresultatscontroles()
	{
		return $this->hasMany(Detailsresultatscontrole::class);
	}
}
