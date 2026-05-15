<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Suivistage
 * 
 * @property int $id
 * @property int $stages_id
 * @property Carbon $date_visite
 * @property string|null $type_suivi
 * @property string|null $compte_rendu
 * @property string|null $difficultes
 * @property string|null $decision
 * @property string|null $encadreur
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Suivistage extends Model
{
	protected $table = 'suivistages';

	protected $casts = [
		'stages_id' => 'int'
	];

	protected $dates = [
		'date_visite'
	];

	protected $fillable = [
		'stages_id',
		'date_visite',
		'type_suivi',
		'compte_rendu',
		'difficultes',
		'decision',
		'encadreur'
	];
	
	/**
	 * Get stage that owns suivistage.
	 */
	public function stage()
	{
		return $this->belongsTo(Stage::class, 'stages_id');
	}
}
