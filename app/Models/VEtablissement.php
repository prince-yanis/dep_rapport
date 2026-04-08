<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VEtablissement
 * 
 * @property int $id
 * @property string|null $denominationetab
 * @property string $code
 * @property string|null $numautorisationouverture
 * @property string|null $numautorisationcreation
 * @property string|null $telephone
 * @property int|null $ordre_id
 * @property string|null $ordre_libelle
 * @property int|null $direction_id
 * @property string|null $direction_libelle
 *
 * @package App\Models
 */
class VEtablissement extends Model
{
	protected $table = 'v_etablissements';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'ordre_id' => 'int',
		'direction_id' => 'int'
	];

	protected $fillable = [
		'id',
		'denominationetab',
		'code',
		'numautorisationouverture',
		'numautorisationcreation',
		'telephone',
		'ordre_id',
		'ordre_libelle',
		'direction_id',
		'direction_libelle'
	];
}
