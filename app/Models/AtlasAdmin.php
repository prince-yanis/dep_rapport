<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AtlasAdmin
 * 
 * @property int $id_etab
 * @property string|null $denominationetab
 * @property int|null $id_district
 * @property string|null $denominationdistrict
 * @property int|null $id_region
 * @property string|null $denominationregion
 * @property int|null $id_departement
 * @property string|null $denominationdepartement
 * @property int|null $id_commune
 * @property string|null $denominationcommune
 *
 * @package App\Models
 */
class AtlasAdmin extends Model
{
	protected $table = 'atlas_admin';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_etab' => 'int',
		'id_district' => 'int',
		'id_region' => 'int',
		'id_departement' => 'int',
		'id_commune' => 'int'
	];

	protected $fillable = [
		'id_etab',
		'denominationetab',
		'id_district',
		'denominationdistrict',
		'id_region',
		'denominationregion',
		'id_departement',
		'denominationdepartement',
		'id_commune',
		'denominationcommune'
	];
}
