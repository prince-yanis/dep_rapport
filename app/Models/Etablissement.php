<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Etablissement
 * 
 * @property int $id
 * @property string|null $denominationetab
 * @property string $code
 * @property string|null $sigle
 * @property string|null $date_ouverture
 * @property string|null $date_creation
 * @property string|null $localisation
 * @property string|null $adresse
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $telephone
 * @property string|null $email
 * @property string|null $contact
 * @property string|null $email_2
 * @property Carbon|null $datecreation
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $communes_id
 * @property int $directiondepartementales_id
 * @property int $ordre_enseignement_id
 *
 * @package App\Models
 */
class Etablissement extends Model
{
	protected $table = 'etablissements';

	protected $casts = [
		'communes_id' => 'int',
		'directiondepartementales_id' => 'int',
		'ordre_enseignement_id' => 'int'
	];

	protected $dates = [
		'datecreation'
	];

	protected $fillable = [
		'denominationetab',
		'code',
		'sigle',
		'date_ouverture',
		'date_creation',
		'localisation',
		'adresse',
		'latitude',
		'longitude',
		'telephone',
		'email',
		'contact',
		'email_2',
		'datecreation',
		'communes_id',
		'directiondepartementales_id',
		'ordre_enseignement_id'
	];

	public function etablissementannees()
	{
		return $this->hasMany(Etablissementannee::class, 'etablissements_id');
	}
}
