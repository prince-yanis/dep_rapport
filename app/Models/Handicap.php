<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Handicap
 * 
 * @property int $id
 * @property string $libelle_handicap
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $created_by
 * @property string $updated_by
 * @property int $typeshandicaps_id
 * 
 * @property Typeshandicap $typeshandicap
 *
 * @package App\Models
 */
class Handicap extends Model
{
	protected $table = 'handicaps';

	protected $casts = [
		'typeshandicaps_id' => 'int'
	];

	protected $fillable = [
		'libelle_handicap',
		'created_by',
		'updated_by',
		'typeshandicaps_id'
	];

	public function typeshandicap()
	{
		return $this->belongsTo(Typeshandicap::class, 'typeshandicaps_id');
	}
}
