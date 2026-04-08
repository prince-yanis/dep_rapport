<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Personnel
 * 
 * @property int $id
 * @property string|null $matricule
 * @property string|null $nom
 * @property string|null $prenoms
 * @property Carbon|null $datenaissance
 * @property string|null $lieunaissance
 * @property string|null $sexe
 * @property string|null $telephone
 * @property string|null $email
 * @property string|null $numeroautorisation
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $typepersonnels_id
 * @property int|null $diplomepersonnels_id
 * @property int|null $fonctionpersonnels_id
 * 
 * @property Collection|Planning[] $plannings
 *
 * @package App\Models
 */
class Personnel extends Model
{
	protected $table = 'personnels';

	protected $casts = [
		'typepersonnels_id' => 'int',
		'diplomepersonnels_id' => 'int',
		'fonctionpersonnels_id' => 'int'
	];

	protected $dates = [
		'datenaissance'
	];

	protected $fillable = [
		'matricule',
		'nom',
		'prenoms',
		'datenaissance',
		'lieunaissance',
		'sexe',
		'telephone',
		'email',
		'numeroautorisation',
		'typepersonnels_id',
		'diplomepersonnels_id',
		'fonctionpersonnels_id'
	];

	public function plannings()
	{
		return $this->hasMany(Planning::class, 'personnels_id');
	}
}
