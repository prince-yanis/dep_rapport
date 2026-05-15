<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MiseEnStage
 * 
 * @property int $id
 * @property int $filieres_id
 * @property int|null $etablissementannees_id
 * @property int|null $nombre_stagiaire
 * @property int|null $nombre_mis_en_stage
 * @property float|null $taux
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class MiseEnStage extends Model
{
	protected $table = 'mise_en_stages';

	protected $casts = [
		'filieres_id' => 'int',
		'etablissementannees_id' => 'int',
		'nombre_stagiaire' => 'int',
		'nombre_mis_en_stage' => 'int',
		'taux' => 'float'
	];

	protected $fillable = [
		'filieres_id',
		'etablissementannees_id',
		'nombre_stagiaire',
		'nombre_mis_en_stage',
		'taux'
	];

	public function etablissementannee()
	{
		return $this->belongsTo(Etablissementannee::class, 'etablissementannees_id');
	}

	public function filiere()
	{
		return $this->belongsTo(Filiere::class, 'filieres_id');
	}
}
