<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Filiereautorise
 * 
 * @property int $id
 * @property string|null $observation
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $resultatsmission_id
 * @property int $filieres_id
 * @property int $diplomeprepares_id
 * @property int $ordre_enseignement_id
 * @property int|null $capaciteacceuil
 * 
 * @property Diplomeprepare $diplomeprepare
 * @property Filiere $filiere
 * @property OrdreEnseignement $ordre_enseignement
 *
 * @package App\Models
 */
class Filiereautorise extends Model
{
	protected $table = 'filiereautorises';

	protected $casts = [
		'resultatsmission_id' => 'int',
		'filieres_id' => 'int',
		'diplomeprepares_id' => 'int',
		'ordre_enseignement_id' => 'int',
		'capaciteacceuil' => 'int'
	];

	protected $fillable = [
		'observation',
		'resultatsmission_id',
		'filieres_id',
		'diplomeprepares_id',
		'ordre_enseignement_id',
		'capaciteacceuil'
	];

	public function diplomeprepare()
	{
		return $this->belongsTo(Diplomeprepare::class, 'diplomeprepares_id');
	}

	public function filiere()
	{
		return $this->belongsTo(Filiere::class, 'filieres_id');
	}

	public function ordre_enseignement()
	{
		return $this->belongsTo(OrdreEnseignement::class);
	}
}
