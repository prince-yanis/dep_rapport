<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Fondateur
 * 
 * @property int $id
 * @property int $fonctionpersonnels_id
 * @property string|null $nom
 * @property string|null $prenom
 * @property string|null $email
 * @property string|null $contact
 * @property string|null $contact_2
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Etablissement[] $etablissements
 * @property Collection|Participant[] $participants
 *
 * @package App\Models
 */
class Fondateur extends Model
{
	protected $table = 'fondateurs';

	protected $casts = [
		'fonctionpersonnels_id' => 'int'
	];

	protected $fillable = [
		'nom',
		'prenom',
		'email',
		'fonctionpersonnels_id',
		'contact',
		'contact_2'
	];

	public function etablissements()
	{
		return $this->belongsToMany(Etablissement::class, 'fondateuretablissements', 'fondateurs_id', 'etablissements_id')
					->withPivot('id')
					->withTimestamps();
	}

	public function participants()
	{
		return $this->hasMany(Participant::class, 'fondateurs_id');
	}
	
	public function fondateuretablissements()
{
    return $this->hasMany(Fondateuretablissement::class, 'fondateurs_id');
}

}
