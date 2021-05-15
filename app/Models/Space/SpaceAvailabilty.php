<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SpaceAvailabilty
 * 
 * @property int $id
 * @property int $space_id
 * @property string $day_week
 * @property int $opening_hour
 * @property int $closing_hour
 * 
 * @property Space $space
 *
 * @package App\Models
 */
class SpaceAvailabilty extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'space_id' => 'int',
		'opening_hour' => 'int',
		'closing_hour' => 'int'
	];

	protected $fillable = [
		'space_id',
		'day_week',
		'opening_hour',
		'closing_hour'
	];

	public function space()
	{
		return $this->belongsTo(Space::class);
	}
}
