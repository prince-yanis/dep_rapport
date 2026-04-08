<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Resultatstypesequipement
 * 
 * @property int $id
 * @property string|null $observationpartielles
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $resultatsmission_id
 * 
 * @property Resultatsmission $resultatsmission
 * @property Collection|Detailsequipement[] $detailsequipements
 * @property Collection|Detailsinfrastructure[] $detailsinfrastructures
 *
 * @package App\Models
 */
class Resultatstypesequipement extends Model
{
	protected $table = 'resultatstypesequipement';

	protected $casts = [
		'resultatsmission_id' => 'int'
	];

	protected $fillable = [
		'observationpartielles',
		'resultatsmission_id'
	];

	public function resultatsmission()
	{
		return $this->belongsTo(Resultatsmission::class);
	}

	public function detailsequipements()
	{
		return $this->hasMany(Detailsequipement::class);
	}

	public function detailsinfrastructures()
	{
		return $this->hasMany(Detailsinfrastructure::class);
	}
}
