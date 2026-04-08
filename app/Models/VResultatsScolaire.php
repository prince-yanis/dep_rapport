<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VResultatsScolaire
 * 
 * @property int $id
 * @property string $total_admis
 * @property float|null $taux
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
class VResultatsScolaire extends Model
{
	protected $table = 'v_resultats_scolaire';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'taux' => 'float',
		'filieres_id' => 'int',
		'ordre_id' => 'int',
		'etablissementannees_id' => 'int',
		'etablissements_id' => 'int',
		'anneescolaires_id' => 'int'
	];

	protected $fillable = [
		'id',
		'total_admis',
		'taux',
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
