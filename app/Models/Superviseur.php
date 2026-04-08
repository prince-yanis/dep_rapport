<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Superviseur
 * 
 * @property int $id
 * @property string|null $matricule
 * @property string|null $nom
 * @property string|null $prenoms
 * @property string|null $telephone
 * @property string|null $email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $structure_id
 * 
 * @property Structure $structure
 * @property Collection|Participantsmission[] $participantsmissions
 *
 * @package App\Models
 */
class Superviseur extends Model
{
	protected $table = 'superviseur';

	protected $casts = [
		'structure_id' => 'int'
	];

	protected $fillable = [
		'matricule',
		'nom',
		'prenoms',
		'telephone',
		'email',
		'structure_id'
	];

	public function structure()
	{
		return $this->belongsTo(Structure::class);
	}

	public function participantsmissions()
	{
		return $this->hasMany(Participantsmission::class);
	}
}
