<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SpaceExtrasCustom
 * 
 * @property int $id
 * @property int $space_id
 * @property string $name
 * @property string $description
 * 
 * @property Space $space
 *
 * @package App\Models
 */
class SpaceExtrasCustom extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'space_id' => 'int'
	];

	protected $fillable = [
		'space_id',
		'name',
		'description'
	];

	public function space()
	{
		return $this->belongsTo(Space::class);
	}
}
