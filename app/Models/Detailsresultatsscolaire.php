<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

/**
 * Class Detailsresultatsscolaire
 * 
 * @property int $id
 * @property int|null $present
 * @property int|null $admis
 * @property float|null $taux
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $anneescolaires_id
 * @property int $resultatsscolaire_id
 * 
 * @property Anneescolaire $anneescolaire
 * @property Resultatsscolaire $resultatsscolaire
 *
 * @package App\Models
 */
class Detailsresultatsscolaire extends Model
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->present > 0) {
                $model->taux = round(($model->admis / $model->present) * 100, 2);
            } else {
                $model->taux = 0;
            }
        });
    }
	protected $table = 'detailsresultatsscolaire';

	protected $casts = [
		'present' => 'int',
		'admis' => 'int',
		'taux' => 'float',
		'anneescolaires_id' => 'int',
		'resultatsscolaire_id' => 'int'
	];

	protected $fillable = [
		'present',
		'admis',
		'taux',
		'anneescolaires_id',
		'resultatsscolaire_id'
	];

	public function anneescolaire()
	{
		return $this->belongsTo(Anneescolaire::class, 'anneescolaires_id');
	}

	public function resultatsscolaire()
	{
		return $this->belongsTo(Resultatsscolaire::class);
	}
}
