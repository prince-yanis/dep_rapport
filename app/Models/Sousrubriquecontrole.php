<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sousrubriquecontrole
 * 
 * @property int $id
 * @property string|null $libellesousrubrique
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Itemscontrole[] $itemscontroles
 *
 * @package App\Models
 */
class Sousrubriquecontrole extends Model
{
	protected $table = 'sousrubriquecontrole';

	protected $fillable = [
		'libellesousrubrique'
	];

	public function rubriquecontrole()
	{
		return $this->belongsTo(Rubriquecontrole::class);
	}

	public function itemscontroles()
	{
		return $this->hasMany(Itemscontrole::class);
	}

	public function resultatscontroles()
	{
		return $this->hasMany(Resultatscontrole::class);
	}
}
