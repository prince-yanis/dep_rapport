<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Personnelannee
 * 
 * @property int $id
 * @property string|null $quotahoraire
 * @property string|null $nbreheureeffectuee
 * @property string|null $nbreheureresponsabilite
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $personnels_id
 * @property int|null $disciplines_id
 * @property bool $cons_ens
 * @property int $etablissementannees_id
 * @property int|null $statutpersonnel_id
 * @property int|null $fonctionpersonnels_id
 * @property int|null $niveauenseignant_id
 *
 * @package App\Models
 */
class Personnelannee extends Model
{
	protected $table = 'personnelannees';

	protected $casts = [
		'personnels_id' => 'int',
		'disciplines_id' => 'int',
		'cons_ens' => 'bool',
		'etablissementannees_id' => 'int',
		'statutpersonnel_id' => 'int',
		'fonctionpersonnels_id' => 'int',
		'niveauenseignant_id' => 'int'
	];

	protected $fillable = [
		'quotahoraire',
		'nbreheureeffectuee',
		'nbreheureresponsabilite',
		'personnels_id',
		'disciplines_id',
		'cons_ens',
		'etablissementannees_id',
		'statutpersonnel_id',
		'fonctionpersonnels_id',
		'niveauenseignant_id'
	];
	
	public function personnel()
	{
		return $this->belongsTo(Personnel::class, 'personnels_id');
	}
	public function etablissementannee()
	{
		return $this->belongsTo(EtablissementAnnee::class, 'etablissementannees_id'); // Assurez-vous d'avoir un modèle correspondant à `etablissementannees`
	}
}
