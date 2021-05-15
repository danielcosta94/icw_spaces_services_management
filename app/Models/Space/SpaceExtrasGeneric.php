<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SpaceExtrasGeneric
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * 
 * @property \Illuminate\Database\Eloquent\Collection $space_extras
 *
 * @package App\Models
 */
class SpaceExtrasGeneric extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'name',
		'description'
	];

	public function space_extras()
	{
		return $this->hasMany(SpaceExtra::class, 'space_extra_id');
	}
}
