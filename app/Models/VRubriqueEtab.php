<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VRubriqueEtab
 * 
 * @property int $id
 * @property int|null $rubriquecontrole_id
 * @property int $mission_id
 * @property string|null $recommandation
 * @property string|null $observation
 * @property string|null $periode_execution
 * @property int|null $rubriquecontroles_id
 * @property string|null $libellerubrique
 * @property int|null $missions_id
 * @property int|null $etablissementannees_id
 * @property int|null $etabannee_id
 * @property int|null $etablissements_id
 * @property int|null $anneescolaires_id
 * @property string|null $denominationetab
 * @property string|null $libelleanneescolaire
 *
 * @package App\Models
 */
class VRubriqueEtab extends Model
{
	protected $table = 'v_rubrique_etab';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'rubriquecontrole_id' => 'int',
		'mission_id' => 'int',
		'rubriquecontroles_id' => 'int',
		'missions_id' => 'int',
		'etablissementannees_id' => 'int',
		'etabannee_id' => 'int',
		'etablissements_id' => 'int',
		'anneescolaires_id' => 'int'
	];

	protected $fillable = [
		'id',
		'rubriquecontrole_id',
		'mission_id',
		'recommandation',
		'observation',
		'periode_execution',
		'rubriquecontroles_id',
		'libellerubrique',
		'missions_id',
		'etablissementannees_id',
		'etabannee_id',
		'etablissements_id',
		'anneescolaires_id',
		'denominationetab',
		'libelleanneescolaire'
	];
}
