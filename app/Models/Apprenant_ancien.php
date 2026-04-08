<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Apprenant
 * 
 * @property int $id
 * @property string|null $matriculeap
 * @property string|null $nom
 * @property string|null $prenoms
 * @property string|null $datenaissance
 * @property string|null $lieunaissance
 * @property string|null $telephone
 * @property string|null $email
 * @property string|null $sexe
 * @property string|null $nationalite
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Apprenant extends Model
{
	protected $table = 'apprenants';

	protected $fillable = [
		'matriculeap',
		'nom',
		'prenoms',
		'datenaissance',
		'lieunaissance',
		'telephone',
		'email',
		'sexe',
		'nationalite'
	];
	public function apprenantannees()
	{
		return $this->hasMany(Apprenantannee::class, 'apprenants_id');
	}
}
