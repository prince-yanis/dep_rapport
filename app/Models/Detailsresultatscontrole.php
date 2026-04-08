<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Detailsresultatscontrole
 * 
 * @property int $id
 * @property int|null $existence
 * @property int|null $observations
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $itemscontrole_id
 * @property int $resultatscontrole_id
 * 
 * @property Itemscontrole $itemscontrole
 * @property Resultatscontrole $resultatscontrole
 *
 * @package App\Models
 */
class Detailsresultatscontrole extends Model
{
	protected $table = 'detailsresultatscontrole';

	protected $casts = [
		'existence' => 'int',
		'observations' => 'int',
		'itemscontrole_id' => 'int',
		'resultatscontrole_id' => 'int'
	];

	protected $fillable = [
		'existence',
		'observations',
		'itemscontrole_id',
		'resultatscontrole_id'
	];

	public function itemscontrole()
	{
		return $this->belongsTo(Itemscontrole::class);
	}

	public function resultatscontrole()
	{
		return $this->belongsTo(Resultatscontrole::class);
	}
}
