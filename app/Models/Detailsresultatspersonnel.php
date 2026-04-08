<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Detailsresultatspersonnel
 * 
 * @property int $id
 * @property int|null $effectif
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $autorise
 * @property int|null $nbredossierphysique
 * @property int $fonctionpersonnels_id
 * @property int $resultatstypepersonnel_id
 * 
 * @property Fonctionpersonnel $fonctionpersonnel
 * @property Resultatstypepersonnel $resultatstypepersonnel
 *
 * @package App\Models
 */
class Detailsresultatspersonnel extends Model
{
	protected $table = 'detailsresultatspersonnel';

	protected $casts = [
		'effectif' => 'int',
		'autorise' => 'int',
		'nbredossierphysique' => 'int',
		'fonctionpersonnels_id' => 'int',
		'resultatstypepersonnel_id' => 'int'
	];

	protected $fillable = [
		'effectif',
		'autorise',
		'nbredossierphysique',
		'fonctionpersonnels_id',
		'resultatstypepersonnel_id'
	];

	public function fonctionpersonnel()
	{
		return $this->belongsTo(Fonctionpersonnel::class, 'fonctionpersonnels_id');
	}

	public function resultatstypepersonnel()
	{
		return $this->belongsTo(Resultatstypepersonnel::class);
	}
}
