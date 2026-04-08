<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Anneescolaire
 * 
 * @property int $id
 * @property string|null $libelleanneescolaire
 * @property Carbon|null $rapport1
 * @property Carbon|null $rapport2
 * @property Carbon|null $rapport3
 * @property Carbon|null $datedebut
 * @property Carbon|null $datefin
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Detailsresultatsscolaire[] $detailsresultatsscolaires
 *
 * @package App\Models
 */
class Anneescolaire extends Model
{
	protected $table = 'anneescolaires';

	protected $dates = [
		'rapport1',
		'rapport2',
		'rapport3',
		'datedebut',
		'datefin'
	];

	protected $fillable = [
		'libelleanneescolaire',
		'rapport1',
		'rapport2',
		'rapport3',
		'datedebut',
		'datefin'
	];

	public function detailsresultatsscolaires()
	{
		return $this->hasMany(Detailsresultatsscolaire::class, 'anneescolaires_id');
	}
}
