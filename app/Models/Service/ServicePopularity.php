<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ServicePopularity
 * 
 * @property int $id
 * @property int $service_id
 * @property int $action_type_id
 * @property \Carbon\Carbon $created_at
 * 
 * @property ActionType $action_type
 * @property Service $service
 *
 * @package App\Models
 */
class ServicePopularity extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'service_id' => 'int',
		'action_type_id' => 'int'
	];

	protected $fillable = [
		'service_id',
		'action_type_id'
	];

	public function action_type()
	{
		return $this->belongsTo(ActionType::class);
	}

	public function service()
	{
		return $this->belongsTo(Service::class);
	}
}
