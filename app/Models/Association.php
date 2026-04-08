<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Association
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property string|null $designation
 * @property string|null $objet
 * @property string|null $nomresponsable
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Etablissementannee[] $etablissementannees
 *
 * @package App\Models
 */
class Association extends Model
{
	protected $table = 'associations';

	protected $casts = [
		'etablissementannees_id' => 'int'
	];

	protected $fillable = [
		'etablissementannees_id',
		'designation',
		'objet',
		'nomresponsable'
	];

	public function etablissementannees()
	{
		return $this->hasMany(Etablissementannee::class, 'associations_id');
	}
}
