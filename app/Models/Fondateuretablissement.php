<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Fondateuretablissement
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $etablissements_id
 * @property int $fondateurs_id
 * 
 * @property Etablissement $etablissement
 * @property Fondateur $fondateur
 *
 * @package App\Models
 */
class Fondateuretablissement extends Model
{
	protected $table = 'fondateuretablissements';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'etablissements_id' => 'int',
		'fondateurs_id' => 'int'
	];

	protected $fillable = [
		'etablissements_id',
		'fondateurs_id'
	];

	public function etablissement()
	{
		return $this->belongsTo(Etablissement::class, 'etablissements_id');
	}

	public function fondateur()
	{
		return $this->belongsTo(Fondateur::class, 'fondateurs_id');
	}
}
