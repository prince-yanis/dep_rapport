<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Typeshandicap
 * 
 * @property int $id
 * @property string $libelle_typeshandicap
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $created_by
 * @property string $updated_by
 * 
 * @property Collection|Handicap[] $handicaps
 *
 * @package App\Models
 */
class Typeshandicap extends Model
{
	protected $table = 'typeshandicaps';

	protected $fillable = [
		'libelle_typeshandicap',
		'created_by',
		'updated_by'
	];

	public function handicaps()
	{
		return $this->hasMany(Handicap::class, 'typeshandicaps_id');
	}
}
