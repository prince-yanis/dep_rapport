<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SportEtab
 * 
 * @property int $etablissementannees_id
 * @property int $sport_id
 *
 * @package App\Models
 */
class SportEtab extends Model
{
	protected $table = 'sport_etab';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'etablissementannees_id' => 'int',
		'sport_id' => 'int'
	];

	protected $fillable = [
		'etablissementannees_id',
		'sport_id'
	];
}
