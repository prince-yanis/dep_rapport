<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Niveauenseignant
 * 
 * @property int $id
 * @property string|null $libelleniveau
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Niveauenseignant extends Model
{
	protected $table = 'niveauenseignant';

	protected $fillable = [
		'libelleniveau'
	];
	
	public function besoinpersonnelens()
	{
		return $this->hasMany(Besoinpersonnelen::class, 'niveauenseignant_id');
	}
}
