<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Materiel
 * 
 * @property int $id
 * @property string|null $libellemateriel
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Materiel extends Model
{
	protected $table = 'materiels';

	protected $fillable = [
		'libellemateriel'
	];
}
