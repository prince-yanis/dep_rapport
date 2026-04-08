<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Participant
 * 
 * @property int $id
 * @property string|null $status
 * @property int $fondateurs_id
 * @property int $sessionformations_id
 * @property Carbon|null $date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Fondateur $fondateur
 * @property Sessionformation $sessionformation
 *
 * @package App\Models
 */
class Participant extends Model
{
	protected $table = 'participants';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'fondateurs_id' => 'int',
		'sessionformations_id' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'status',
		'fondateurs_id',
		'sessionformations_id',
		'date'
	];

	public function fondateur()
	{
		return $this->belongsTo(Fondateur::class, 'fondateurs_id');
	}

	public function sessionformation()
	{
		return $this->belongsTo(Sessionformation::class, 'sessionformations_id');
	}
}
