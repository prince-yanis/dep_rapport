<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Fonctionparticipant
 * 
 * @property int $id
 * @property string $libellefonction
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Collection|Participantsmission[] $participantsmissions
 *
 * @package App\Models
 */
class Fonctionparticipant extends Model
{
	protected $table = 'fonctionparticipants';

	protected $fillable = [
		'libellefonction'
	];

	public function participantsmissions()
	{
		return $this->hasMany(Participantsmission::class, 'fonctionparticipants_id');
	}
}
