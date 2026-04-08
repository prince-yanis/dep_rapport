<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Parametresglobaux
 * 
 * @property int $id
 * @property int|null $anneescolaires_id
 * @property string|null $nompays
 * @property string|null $ministere
 * @property string|null $nomDirection
 * @property string|null $email
 * @property string|null $adresse
 * @property string|null $telephone
 * @property string|null $fax
 *
 * @package App\Models
 */
class Parametresglobaux extends Model
{
	protected $table = 'parametresglobaux';
	public $timestamps = false;

	protected $casts = [
		'anneescolaires_id' => 'int'
	];

	protected $fillable = [
		'anneescolaires_id',
		'nompays',
		'ministere',
		'nomDirection',
		'email',
		'adresse',
		'telephone',
		'fax'
	];
}
