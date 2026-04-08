<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TcdEtablissementAnnee
 * 
 * @property int $id
 * @property int $id_etab
 * @property int $id_annee
 * @property string|null $libelleanneescolaire
 * @property int|null $directiondepartementales_id
 * @property string|null $denominationdd
 * @property int|null $directionregionales_id
 * @property string|null $denominationdr
 * @property int|null $communes_id
 * @property string|null $denominationcommune
 * @property int|null $ordre_enseignement_id
 * @property string|null $libelleenseignement
 * @property string|null $denominationetab
 * @property string|null $code
 * @property string|null $datecreation
 * @property string|null $numautorisationouverture
 * @property string|null $numautorisationcreation
 * @property string|null $capacite
 * @property string|null $localisation
 * @property string|null $adresse
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $telephone
 * @property string|null $email
 * @property string|null $nomfondateur
 * @property string|null $contact
 *
 * @package App\Models
 */
class TcdEtablissementAnnee extends Model
{
	protected $table = 'tcd_etablissement_annee';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'id_etab' => 'int',
		'id_annee' => 'int',
		'directiondepartementales_id' => 'int',
		'directionregionales_id' => 'int',
		'communes_id' => 'int',
		'ordre_enseignement_id' => 'int'
	];

	protected $fillable = [
		'id',
		'id_etab',
		'id_annee',
		'existecloture',
		'problemeequipement',
		'libelleanneescolaire',
		'directiondepartementales_id',
		'denominationdd',
		'directionregionales_id',
		'denominationdr',
		'communes_id',
		'denominationcommune',
		'ordre_enseignement_id',
		'libelleenseignement',
		'denominationetab',
		'code',
		'datecreation',
		'numautorisationouverture',
		'numautorisationcreation',
		'capacite',
		'localisation',
		'adresse',
		'latitude',
		'longitude',
		'telephone',
		'email',
		'nomfondateur',
		'contact'
	];
}
