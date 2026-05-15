<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Stage
 * 
 * @property int $id
 * @property int $apprenantannees_id
 * @property int $entreprises_id
 * @property Carbon $date_debut
 * @property Carbon $date_fin
 * @property string|null $theme_stage
 * @property string|null $service_affectation
 * @property string|null $tuteur_entreprise
 * @property string|null $telephone_tuteur
 * @property string|null $email_tuteur
 * @property string|null $statut_stage
 * @property float|null $note_stage
 * @property bool|null $rapport_depose
 * @property bool|null $soutenance_effectuee
 * @property string|null $observation
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Stage extends Model
{
	protected $table = 'stages';

	protected $casts = [
		'apprenantannees_id' => 'int',
		'entreprises_id' => 'int',
		'note_stage' => 'float',
		'rapport_depose' => 'bool',
		'soutenance_effectuee' => 'bool'
	];

	protected $dates = [
		'date_debut',
		'date_fin'
	];

	protected $fillable = [
		'apprenantannees_id',
		'entreprises_id',
		'date_debut',
		'date_fin',
		'theme_stage',
		'service_affectation',
		'tuteur_entreprise',
		'telephone_tuteur',
		'email_tuteur',
		'statut_stage',
		'note_stage',
		'rapport_depose',
		'soutenance_effectuee',
		'observation'
	];
	
	/**
	 * Get the entreprise that owns the stage.
	 */
	public function entreprise()
	{
		return $this->belongsTo(Entreprise::class, 'entreprises_id');
	}
	
	/**
	 * Get the apprenantannee that owns the stage.
	 */
	public function apprenantannee()
	{
		return $this->belongsTo(Apprenantannee::class, 'apprenantannees_id');
	}
	
	/**
	 * Get the suivistages for the stage.
	 */
	public function suivistages()
	{
		return $this->hasMany(Suivistage::class, 'stages_id');
	}
}
