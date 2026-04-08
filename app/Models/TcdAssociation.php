<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TcdAssociation
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property string|null $denominationetab
 * @property string|null $libelleanneescolaire
 * @property int|null $directiondepartementales_id
 * @property string|null $denominationdd
 * @property int|null $directionregionales_id
 * @property string|null $denominationdr
 * @property string|null $designation
 * @property string|null $objet
 * @property string|null $nomresponsable
 *
 * @package App\Models
 */
class TcdAssociation extends Model
{
	protected $table = 'tcd_association';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'etablissementannees_id' => 'int',
		'directiondepartementales_id' => 'int',
		'directionregionales_id' => 'int'
	];

	protected $fillable = [
		'id',
		'etablissementannees_id',
		'denominationetab',
		'libelleanneescolaire',
		'directiondepartementales_id',
		'denominationdd',
		'directionregionales_id',
		'denominationdr',
		'designation',
		'objet',
		'nomresponsable'
	];
}
