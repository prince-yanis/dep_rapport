<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TcdSuiviRemplissage
 * 
 * @property int $id
 * @property string|null $libelleanneescolaire
 * @property string|null $DR
 * @property string|null $denominationcommune
 * @property string|null $libelleenseignement
 * @property string|null $denominationetab
 * @property string|null $code
 * @property string|null $numautorisationouverture
 * @property string|null $numautorisationcreation
 * @property string|null $capacite
 * @property string|null $localisation
 * @property string|null $adresse
 * @property string|null $telephone
 * @property string|null $email
 * @property string|null $nomfondateur
 * @property string|null $contact
 * @property int|null $rapport_rentrée
 * @property int|null $rapport_1erSemestre
 * @property int|null $rapport_2emeSemestre
 *
 * @package App\Models
 */
class TcdSuiviRemplissage extends Model
{
	protected $table = 'tcd_suivi_remplissage';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'rapport_rentrée' => 'int',
		'rapport_1erSemestre' => 'int',
		'rapport_2emeSemestre' => 'int'
	];

	protected $fillable = [
		'id',
		'libelleanneescolaire',
		'DR',
		'denominationcommune',
		'libelleenseignement',
		'denominationetab',
		'code',
		'numautorisationouverture',
		'numautorisationcreation',
		'capacite',
		'localisation',
		'adresse',
		'telephone',
		'email',
		'nomfondateur',
		'contact',
		'rapport_rentrée',
		'rapport_1erSemestre',
		'rapport_2emeSemestre'
	];
}
