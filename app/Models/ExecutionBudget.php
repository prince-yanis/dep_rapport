<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExecutionBudget
 * 
 * @property int $id
 * @property int $etablissementannees_id
 * @property string|null $ligne_budgetaire
 * @property string|null $designation
 * @property int|null $dotation
 * @property int|null $engagement
 * @property int|null $solde
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class ExecutionBudget extends Model
{
	protected $table = 'execution_budgets';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'etablissementannees_id' => 'int',
		'dotation' => 'int',
		'engagement' => 'int',
		'solde' => 'int'
	];

	protected $fillable = [
		'id',
		'etablissementannees_id',
		'ligne_budgetaire',
		'designation',
		'dotation',
		'engagement',
		'solde'
	];
}
