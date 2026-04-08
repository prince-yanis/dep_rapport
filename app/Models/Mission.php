<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Mission
 * 
 * @property int $id
 * @property Carbon|null $date
 * @property Carbon|null $date_fin
 * @property Carbon|null $date_visite
 * @property string|null $date_derniere_visite
 * @property string|null $responsableetab
 * @property string|null $contactresponsableetab
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $emailresponsableetab
 * @property int|null $visite
 * @property int $etablissementannees_id
 * 
 * @property Etablissementannee $etablissementannee
 * @property Collection|Participantsmission[] $participantsmissions
 * @property Collection|Resultatsmission[] $resultatsmissions
 *
 * @package App\Models
 */
class Mission extends Model
{
	protected $table = 'mission';

	protected $casts = [
		'etablissementannees_id' => 'int'
	];

	protected $dates = [
		'date',
		'date_fin',
		'date_visite',
	];

	protected $fillable = [
		'date',
		'date_fin',
		'date_visite',
		'date_derniere_visite',
		'responsableetab',
		'contactresponsableetab',
		'emailresponsableetab',
		'visite',
		'etablissementannees_id'
	];

	public function etablissementannee()
	{
		return $this->belongsTo(Etablissementannee::class, 'etablissementannees_id');
	}

	public function participantsmissions()
	{
		return $this->hasMany(Participantsmission::class);
	}

	public function resultatsmissions()
	{
		return $this->hasMany(Resultatsmission::class);
	}
}
