<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ServiceAvailabilty
 * 
 * @property int $id
 * @property int $service_id
 * @property string $day_week
 * @property int $opening_hour
 * @property int $closing_hour
 * 
 * @property Service $service
 *
 * @package App\Models
 */
class ServiceAvailabilty extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'service_id' => 'int',
		'opening_hour' => 'int',
		'closing_hour' => 'int'
	];

	protected $fillable = [
		'service_id',
		'day_week',
		'opening_hour',
		'closing_hour'
	];

	public function service()
	{
		return $this->belongsTo(Service::class);
	}
}
