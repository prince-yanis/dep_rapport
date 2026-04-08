<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Etablissement
 * 
 * @property int $id
 * @property string|null $denominationetab
 * @property string|null $datecreation
 * @property string|null $numautorisationcreation
 * @property string|null $numautorisationouverture
 * @property string|null $localisation
 * @property string|null $adresse
 * @property string|null $telephone
 * @property string|null $email
 * @property string|null $nomfondateur
 * @property string|null $contact
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $communes_id
 * @property int $directiondepartementales_id
 * 
 * @property Collection|Etablissementannee[] $etablissementannees
 *
 * @package App\Models
 */
class Etablissement extends Model
{
	protected $table = 'etablissements';

	protected $casts = [
		'communes_id' => 'int',
		'directiondepartementales_id' => 'int'
	];

	protected $fillable = [
		'denominationetab',
		'datecreation',
		'numautorisationcreation',
		'numautorisationouverture',
		'localisation',
		'adresse',
		'telephone',
		'email',
		'nomfondateur',
		'contact',
		'communes_id',
		'directiondepartementales_id'
	];

	public function etablissementannees()
	{
		return $this->hasMany(Etablissementannee::class, 'etablissements_id');
	}
}
