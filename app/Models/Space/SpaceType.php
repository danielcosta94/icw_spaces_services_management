<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 26 Jul 2017 15:33:48 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SpaceType
 * 
 * @property int $id
 * @property string $space_type
 * @property string $description
 * 
 * @property \Illuminate\Database\Eloquent\Collection $spaces
 *
 * @package App\Models
 */
class SpaceType extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'space_type',
		'description'
	];

	public function spaces()
	{
		return $this->hasMany(\App\Models\Space::class);
	}
}
