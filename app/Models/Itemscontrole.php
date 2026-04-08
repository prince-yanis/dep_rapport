<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Itemscontrole
 * 
 * @property int $id
 * @property string|null $libelleitems
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $sousrubriquecontrole_id
 * 
 * @property Sousrubriquecontrole $sousrubriquecontrole
 * @property Collection|Detailsresultatscontrole[] $detailsresultatscontroles
 *
 * @package App\Models
 */
class Itemscontrole extends Model
{
	protected $table = 'itemscontrole';

	protected $casts = [
		'libelleitems' => 'string',
		'sousrubriquecontrole_id' => 'int'
	];

	protected $fillable = [
		'libelleitems',
		'sousrubriquecontrole_id'
	];

	public function sousrubriquecontrole()
	{
		return $this->belongsTo(Sousrubriquecontrole::class);
	}

	public function detailsresultatscontroles()
	{
		return $this->hasMany(Detailsresultatscontrole::class);
	}
}
