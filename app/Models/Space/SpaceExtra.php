<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SpaceExtra
 * 
 * @property int $id
 * @property int $space_id
 * @property int $space_extra_id
 * 
 * @property SpaceExtrasGeneric $space_extras_generic
 * @property Space $space
 *
 * @package App\Models
 */
class SpaceExtra extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'space_id' => 'int',
		'space_extra_id' => 'int'
	];

	protected $fillable = [
		'space_id',
		'space_extra_id'
	];

	public function space_extras_generic()
	{
		return $this->belongsTo(SpaceExtrasGeneric::class, 'space_extra_id');
	}

	public function space()
	{
		return $this->belongsTo(Space::class);
	}
}
