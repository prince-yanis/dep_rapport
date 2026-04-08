<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Participantsmission
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $mission_id
 * @property int $superviseur_id
 * @property int|null $fonctionparticipants_id
 * 
 * @property Fonctionparticipant|null $fonctionparticipant
 * @property Mission $mission
 * @property Superviseur $superviseur
 *
 * @package App\Models
 */
class Participantsmission extends Model
{
	protected $table = 'participantsmission';

	protected $casts = [
		'mission_id' => 'int',
		'superviseur_id' => 'int',
		'fonctionparticipants_id' => 'int'
	];

	protected $fillable = [
		'mission_id',
		'superviseur_id',
		'fonctionparticipants_id'
	];

	public function fonctionparticipant()
	{
		return $this->belongsTo(Fonctionparticipant::class, 'fonctionparticipants_id');
	}

	public function mission()
	{
		return $this->belongsTo(Mission::class);
	}

	public function superviseur()
	{
		return $this->belongsTo(Superviseur::class);
	}
}
