<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use App\User;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserType
 * 
 * @property int $id
 * @property string $user_type
 * @property string $description
 * 
 * @property \Illuminate\Database\Eloquent\Collection $users
 *
 * @package App\Models
 */
class UserType extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'user_type',
		'description'
	];

	public function users()
	{
		return $this->hasMany(User::class);
	}
}
