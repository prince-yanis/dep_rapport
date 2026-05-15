<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Entreprise
 * 
 * @property int $id
 * @property string $raison_sociale
 * @property string|null $sigle
 * @property string|null $secteur_activite
 * @property string|null $adresse
 * @property string|null $ville
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $telephone
 * @property string|null $email
 * @property string|null $responsable
 * @property string|null $fonction_responsable
 * @property string|null $telephone_responsable
 * @property string|null $email_responsable
 * @property bool|null $statut
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Entreprise extends Model
{
	protected $table = 'entreprises';

	protected $casts = [
		'latitude' => 'float',
		'longitude' => 'float',
		'statut' => 'bool'
	];

	protected $fillable = [
		'raison_sociale',
		'sigle',
		'secteur_activite',
		'adresse',
		'ville',
		'latitude',
		'longitude',
		'telephone',
		'email',
		'responsable',
		'fonction_responsable',
		'telephone_responsable',
		'email_responsable',
		'statut'
	];
	
	/**
	 * Get the stages for the entreprise.
	 */
	public function stages()
	{
		return $this->hasMany(Stage::class, 'entreprises_id');
	}
	
	/**
	 * Get the conventions for the entreprise.
	 */
	public function conventions()
	{
		return $this->hasMany(Convention::class, 'entreprises_id');
	}
}
