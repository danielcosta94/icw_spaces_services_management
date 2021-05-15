<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ActionType
 * 
 * @property int $id
 * @property string $action
 * 
 * @property \Illuminate\Database\Eloquent\Collection $service_popularities
 * @property \Illuminate\Database\Eloquent\Collection $space_popularities
 * @property \Illuminate\Database\Eloquent\Collection $user_actions
 *
 * @package App\Models
 */
class ActionType extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'action'
	];

	public function service_popularities()
	{
		return $this->hasMany(ServicePopularity::class);
	}

	public function space_popularities()
	{
		return $this->hasMany(SpacePopularity::class);
	}

	public function user_actions()
	{
		return $this->hasMany(UserAction::class);
	}
}
