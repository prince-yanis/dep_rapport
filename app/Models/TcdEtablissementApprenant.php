<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TcdEtablissementApprenant
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property string|null $denominationetab
 * @property string|null $libelleanneescolaire
 * @property int|null $directiondepartementales_id
 * @property string|null $denominationdd
 * @property int|null $directionregionales_id
 * @property string|null $denominationdr
 * @property int $apprenants_id
 * @property string|null $matriculeap
 * @property string|null $nom
 * @property string|null $prenoms
 * @property string|null $datenaissance
 * @property string|null $lieunaissance
 * @property string|null $sexe
 * @property string|null $telephone
 * @property string|null $email
 * @property string|null $nationalite
 * @property int $statutapprenants_id
 * @property string|null $libellestatutap
 * @property int $bourses_id
 * @property string|null $libellebourse
 * @property int $classes_id
 * @property string|null $denominationclasse
 * @property int|null $groupepedagogiques_id
 * @property string|null $libellegp
 *
 * @package App\Models
 */
class TcdEtablissementApprenant extends Model
{
	protected $table = 'tcd_etablissement_apprenant';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'etablissementannees_id' => 'int',
		'directiondepartementales_id' => 'int',
		'directionregionales_id' => 'int',
		'apprenants_id' => 'int',
		'statutapprenants_id' => 'int',
		'bourses_id' => 'int',
		'classes_id' => 'int',
		'groupepedagogiques_id' => 'int'
	];

	protected $fillable = [
		'id',
		'etablissementannees_id',
		'denominationetab',
		'libelleanneescolaire',
		'directiondepartementales_id',
		'denominationdd',
		'directionregionales_id',
		'denominationdr',
		'apprenants_id',
		'matriculeap',
		'nom',
		'prenoms',
		'datenaissance',
		'lieunaissance',
		'sexe',
		'telephone',
		'email',
		'nationalite',
		'statutapprenants_id',
		'libellestatutap',
		'bourses_id',
		'libellebourse',
		'classes_id',
		'denominationclasse',
		'groupepedagogiques_id',
		'libellegp'
	];
}
