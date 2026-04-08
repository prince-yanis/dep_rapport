<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Resultatsscolaire
 * 
 * @property int $id
 * @property string|null $observationpartielles
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $resultatsmission_id
 * 
 * @property Resultatsmission $resultatsmission
 * @property Collection|Detailsresultatsscolaire[] $detailsresultatsscolaires
 *
 * @package App\Models
 */
class Resultatsscolaire extends Model
{
	protected $table = 'resultatsscolaire';

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

	public function detailsresultatsscolaires()
	{
		return $this->hasMany(Detailsresultatsscolaire::class);
	}
}
