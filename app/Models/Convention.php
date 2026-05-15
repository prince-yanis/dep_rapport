<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Convention
 * 
 * @property int $id
 * @property int $entreprises_id
 * @property string $numero_convention
 * @property Carbon|null $date_signature
 * @property Carbon|null $date_expiration
 * @property string|null $document
 * @property string|null $statut
 * @property string|null $observation
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Convention extends Model
{
	protected $table = 'conventions';

	protected $casts = [
		'entreprises_id' => 'int'
	];

	protected $dates = [
		'date_signature',
		'date_expiration'
	];

	protected $fillable = [
		'entreprises_id',
		'numero_convention',
		'date_signature',
		'date_expiration',
		'document',
		'statut',
		'observation'
	];
	
	/**
	 * Get entreprise that owns convention.
	 */
	public function entreprise()
	{
		return $this->belongsTo(Entreprise::class, 'entreprises_id');
	}
}
