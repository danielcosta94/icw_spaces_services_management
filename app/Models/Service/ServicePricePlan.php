<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ServicePricePlan
 * 
 * @property int $id
 * @property int $service_id
 * @property int $payment_plan_type_id
 * @property bool $active
 * @property float $price
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property PaymentPlanType $payment_plan_type
 * @property Service $service
 * @property \Illuminate\Database\Eloquent\Collection $service_bookings
 *
 * @package App\Models
 */
class ServicePricePlan extends Eloquent
{
	protected $casts = [
		'service_id' => 'int',
		'payment_plan_type_id' => 'int',
		'active' => 'bool',
		'price' => 'float'
	];

	protected $fillable = [
		'service_id',
		'payment_plan_type_id',
		'active',
		'price'
	];

	public function payment_plan_type()
	{
		return $this->belongsTo(PaymentPlanType::class);
	}

	public function service()
	{
		return $this->belongsTo(Service::class);
	}

	public function service_bookings()
	{
		return $this->hasMany(ServiceBooking::class);
	}
}
