<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminPermission
 * 
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $http_method
 * @property string|null $http_path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class AdminPermission extends Model
{
	protected $table = 'admin_permissions';

	protected $fillable = [
		'name',
		'slug',
		'http_method',
		'http_path'
	];
}
