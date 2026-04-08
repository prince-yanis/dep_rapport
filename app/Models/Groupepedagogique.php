<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Groupepedagogique
 * 
 * @property int $id
 * @property string|null $libellegp
 * @property string|null $ordre
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $niveau_id
 * @property int|null $filieres_id
 * @property int $diplomeprepares_id
 * 
 * @property Collection|Classe[] $classes
 *
 * @package App\Models
 */
class Groupepedagogique extends Model
{
	protected $table = 'groupepedagogiques';

	protected $casts = [
		'niveau_id' => 'int',
		'filieres_id' => 'int',
		'diplomeprepares_id' => 'int'
	];

	protected $fillable = [
		'libellegp',
		'ordre',
		'niveau_id',
		'filieres_id',
		'diplomeprepares_id'
	];

	public function classes()
	{
		return $this->hasMany(Classe::class, 'groupepedagogiques_id');
	}
	public function apprenantannees()
	{
		return $this->hasMany(Apprenantannee::class, 'groupepedagogiques_id');
	}
	public function filiere()
	{
		return $this->belongsTo(Filiere::class, 'filieres_id');
	}
	public function diplomeprepare()
	{
		return $this->belongsTo(Diplomeprepare::class, 'diplomeprepares_id');
	}
	public function niveau()
	{
		return $this->belongsTo(Niveau::class, 'niveau_id');
	}
	
}
