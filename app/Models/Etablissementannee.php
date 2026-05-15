<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Etablissementannee
 * 
 * @property int $id
 * @property string|null $existecloture
 * @property string|null $problemeequipement
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $anneescolaires_id
 * @property int $etablissements_id
 * @property int|null $periodesannuelle_id
 * @property int|null $niveaurentree
 * @property int|null $niveau1semestre
 * @property int|null $niveau2semestre
 * 
 * @property Collection|Mission[] $missions
 *
 * @package App\Models
 */
class Etablissementannee extends Model
{
	protected $table = 'etablissementannees';

	protected $casts = [
		'anneescolaires_id' => 'int',
		'etablissements_id' => 'int',
		'periodesannuelle_id' => 'int',
		'niveaurentree' => 'int',
		'niveau1semestre' => 'int',
		'niveau2semestre' => 'int'
	];

	protected $fillable = [
		'existecloture',
		'problemeequipement',
		'anneescolaires_id',
		'etablissements_id',
		'periodesannuelle_id',
		'niveaurentree',
		'niveau1semestre',
		'niveau2semestre'
	];

	public function missions()
	{
		return $this->hasMany(Mission::class, 'etablissementannees_id');
	}

	public function anneescolaire()
	{
		return $this->belongsTo(Anneescolaire::class, 'anneescolaires_id');
	}

	public function association()
	{
		return $this->hasMany(Association::class, 'etablissementannees_id');
	}

	public function etablissement()
	{
		return $this->belongsTo(Etablissement::class, 'etablissements_id');
	}

	public function classes()
	{
		return $this->hasMany(Classe::class, 'etablissementannees_id');
	}

	public function plannings()
	{
		return $this->hasMany(Planning::class, 'etablissementannees_id');
	}
	public function besoinpersonneladm()
	{
		return $this->hasMany(Besoinpersonneladm::class, 'etablissementannees_id');
	}
	public function besoinpersonnelens()
	{
		return $this->hasMany(Besoinpersonnelen::class, 'etablissementannees_id');
	}
	public function infrastructures()
	{
		return $this->hasMany(Infrastructure::class, 'etablissementannees_id');
	}
	public function besoininfrastructures()
	{
		return $this->hasMany(Besoininfrastructure::class, 'etablissementannees_id');
	}
	public function activitesportive()
	{
		return $this->hasMany(Activitesportive::class, 'etablissementannees_id');
	}
	public function activitesextrascolaires()
	{
		return $this->hasMany(Activitesextrascolaire::class, 'etablissementannees_id');
	}
	public function besoins()
	{
		return $this->hasMany(Besoin::class, 'etablissementannees_id');
	}
	public function personnelannees()
	{
		return $this->hasMany(Personnelannee::class, 'etablissementannees_id');
	}
	public function apprenantannees()
	{
		return $this->hasMany(Apprenantannee::class, 'etablissementannees_id');
	}
	public function resultats()
	{
		return $this->hasMany(Resultat::class, 'etablissementannees_id');
	}
	public function equipements()
	{
		return $this->hasMany(Equipement::class, 'etablissementannees_id');
	}
	
	public function filiereenseignes()
	{
		return $this->hasMany(Filiereenseigne::class, 'etablissementannees_id');
	}
	public function problemes()
	{
		return $this->hasMany(ProblemeUrgent::class, 'etablissementannees_id');
	}
	public function besoinformation()
	{
		return $this->hasMany(Besoinformation::class, 'etablissementannees_id');
	}
	public function resultatexamens()
	{
		return $this->hasMany(Resultatexamen::class, 'etablissementannees_id');
	}
	public function previsions()
	{
		return $this->hasMany(Prevision::class, 'etablissementannees_id');
	}
	public function conclusion()
	{
		return $this->hasMany(Conclusion::class, 'etablissementannees_id');
	}
	public function etatgestion()
	{
		return $this->hasMany(Etatgestion::class, 'etablissementannees_id');
	}
	public function pointexecution()
	{
		return $this->hasMany(PointExecution::class, 'etablissementannees_id');
	}
	public function indicateur()
	{
		return $this->hasMany(Indicateur::class, 'etablissementannees_id');
	}
	
	public function problemeinfrastructure()
	{
		return $this->hasMany(ProblemeInfrastructure::class, 'etablissementannees_id');
	}
	public function equipement()
	{
		return $this->hasMany(Equipement::class, 'etablissementannees_id');
	}
	public function executionbudget()
	{
		return $this->hasMany(ExecutionBudget::class, 'etablissementannees_id');
	}
	public function ressourcesadditionnelle()
	{
		return $this->hasMany(RessourcesAdditionnelle::class, 'etablissementannees_id');
	}
	public function fraisscolarite()
	{
		return $this->hasMany(FraisScolarite::class, 'etablissementannees_id');
	}
	public function travauxexterieur()
	{
		return $this->hasMany(TravauxExterieur::class, 'etablissementannees_id');
	}
	public function comitegestion()
	{
		return $this->hasMany(ComiteGestion::class, 'etablissementannees_id');
	}
	public function perspective()
	{
		return $this->hasMany(Perspective::class, 'etablissementannees_id');
	}
	
	public function miseEnStages()
	{
		return $this->hasMany(MiseEnStage::class, 'etablissementannees_id');
	}
	
	
}
