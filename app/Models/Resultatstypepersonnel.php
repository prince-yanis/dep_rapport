<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Resultatstypepersonnel
 * 
 * @property int $id
 * @property string|null $observationpartielles
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $typepersonnels_id
 * @property int $resultatsmission_id
 * 
 * @property Resultatsmission $resultatsmission
 * @property Typepersonnel $typepersonnel
 * @property Collection|Detailsresultatspersonnel[] $detailsresultatspersonnels
 *
 * @package App\Models
 */
class Resultatstypepersonnel extends Model
{
	protected $table = 'resultatstypepersonnel';

	protected $casts = [
		'typepersonnels_id' => 'int',
		'resultatsmission_id' => 'int'
	];

	protected $fillable = [
		'observationpartielles',
		'typepersonnels_id',
		'resultatsmission_id'
	];

	public function resultatsmission()
	{
		return $this->belongsTo(Resultatsmission::class);
	}

	public function typepersonnel()
	{
		return $this->belongsTo(Typepersonnel::class, 'typepersonnels_id');
	}

	public function detailsresultatspersonnels()
	{
		return $this->hasMany(Detailsresultatspersonnel::class);
	}
}
