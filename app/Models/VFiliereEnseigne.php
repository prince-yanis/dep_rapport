<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VFiliereEnseigne
 * 
 * @property int $id
 * @property string|null $observation
 * @property string|null $numautorisationouverture
 * @property int|null $filieres_id
 * @property string|null $libellefiliere
 * @property int|null $ordre_id
 * @property string|null $libelleenseignement
 * @property int|null $etablissementannees_id
 * @property int|null $etablissements_id
 * @property int|null $anneescolaires_id
 * @property string|null $denominationetab
 * @property string|null $libelleanneescolaire
 *
 * @package App\Models
 */
class VFiliereEnseigne extends Model
{
	protected $table = 'v_filiere_enseignes';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'filieres_id' => 'int',
		'ordre_id' => 'int',
		'etablissementannees_id' => 'int',
		'etablissements_id' => 'int',
		'anneescolaires_id' => 'int'
	];

	protected $fillable = [
		'id',
		'observation',
		'numautorisationouverture',
		'filieres_id',
		'libellefiliere',
		'ordre_id',
		'libelleenseignement',
		'etablissementannees_id',
		'etablissements_id',
		'anneescolaires_id',
		'denominationetab',
		'libelleanneescolaire'
	];
}
