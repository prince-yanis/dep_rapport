<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TcdEtablissementPersonnel
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property string|null $denominationetab
 * @property string|null $libelleanneescolaire
 * @property int|null $directiondepartementales_id
 * @property string|null $DR
 * @property int|null $ordre_enseignement_id
 * @property string|null $libelleenseignement
 * @property int $personnels_id
 * @property string|null $matricule
 * @property string|null $nom
 * @property string|null $prenoms
 * @property Carbon|null $datenaissance
 * @property string|null $lieunaissance
 * @property string|null $sexe
 * @property string|null $telephone
 * @property string|null $email
 * @property string|null $numeroautorisation
 * @property string|null $documentautorisation
 * @property string|null $cv
 * @property int|null $typepersonnels_id
 * @property string|null $libelletypepersonnel
 * @property int|null $diplomepersonnels_id
 * @property string|null $libellediplome
 * @property int|null $disciplines_id
 * @property string|null $libellediscipline
 * @property int|null $niveauenseignant_id
 * @property string|null $libelleniveau
 * @property int|null $statutpersonnel_id
 * @property string|null $libellestatutpers
 * @property int|null $fonctionpersonnels_id
 * @property string|null $libellefonction
 *
 * @package App\Models
 */
class TcdEtablissementPersonnel extends Model
{
	protected $table = 'tcd_etablissement_personnel';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'etablissementannees_id' => 'int',
		'directiondepartementales_id' => 'int',
		'ordre_enseignement_id' => 'int',
		'personnels_id' => 'int',
		'typepersonnels_id' => 'int',
		'diplomepersonnels_id' => 'int',
		'disciplines_id' => 'int',
		'niveauenseignant_id' => 'int',
		'statutpersonnel_id' => 'int',
		'fonctionpersonnels_id' => 'int'
	];

	protected $dates = [
		'datenaissance'
	];

	protected $fillable = [
		'id',
		'etablissementannees_id',
		'denominationetab',
		'libelleanneescolaire',
		'directiondepartementales_id',
		'DR',
		'ordre_enseignement_id',
		'libelleenseignement',
		'personnels_id',
		'matricule',
		'nom',
		'prenoms',
		'datenaissance',
		'lieunaissance',
		'sexe',
		'telephone',
		'email',
		'numeroautorisation',
		'documentautorisation',
		'cv',
		'typepersonnels_id',
		'libelletypepersonnel',
		'diplomepersonnels_id',
		'libellediplome',
		'disciplines_id',
		'libellediscipline',
		'niveauenseignant_id',
		'libelleniveau',
		'statutpersonnel_id',
		'libellestatutpers',
		'fonctionpersonnels_id',
		'libellefonction'
	];
}
