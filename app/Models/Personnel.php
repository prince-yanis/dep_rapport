<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
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
 * @property Carbon|null $date_fonction_public
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $typepersonnels_id
 * @property int|null $diplomepersonnels_id
 *
 * @package App\Models
 */
class Personnel extends Model
{
	protected $table = 'personnels';

	protected $casts = [
		'typepersonnels_id' => 'int',
		'diplomepersonnels_id' => 'int'
	];

	protected $dates = [
		'datenaissance',
		'date_fonction_public'
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
		'date_fonction_public',
		'typepersonnels_id',
		'diplomepersonnels_id'
	];

	public function plannings()
	{
		return $this->hasMany(Planning::class, 'personnels_id');
	}
	public function personnelannees()
	{
		return $this->hasMany(Personnelannee::class, 'personnels_id');
	}
}
