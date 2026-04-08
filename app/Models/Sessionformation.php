<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sessionformation
 * 
 * @property int $id
 * @property Carbon|null $date_debut
 * @property Carbon|null $date_fin
 * @property string|null $libelle
 * @property int|null $capacite
 * @property string|null $total_participant
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Participant[] $participants
 *
 * @package App\Models
 */
class Sessionformation extends Model
{
	protected $table = 'sessionformations';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'capacite' => 'int'
	];

	protected $dates = [
		'date_debut',
		'date_fin'
	];

	protected $fillable = [
		'date_debut',
		'date_fin',
		'libelle',
		'capacite',
		'total_participant'
	];

	public function participants()
	{
		return $this->hasMany(Participant::class, 'sessionformations_id');
	}
}
