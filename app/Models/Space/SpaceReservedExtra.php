<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SpaceReservedExtra
 * 
 * @property int $id
 * @property int $space_reservation_id
 * @property \Carbon\Carbon $date_reservation
 * @property string $name
 * @property string $description
 * @property float $price
 * @property int $quantity
 * @property int $payment_plan_type_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property PaymentPlanType $payment_plan_type
 * @property SpaceBooking $space_booking
 *
 * @package App\Models
 */
class SpaceReservedExtra extends Eloquent
{
	protected $casts = [
		'space_reservation_id' => 'int',
		'price' => 'float',
		'quantity' => 'int',
		'payment_plan_type_id' => 'int'
	];

	protected $dates = [
		'date_reservation'
	];

	protected $fillable = [
		'space_reservation_id',
		'date_reservation',
		'name',
		'description',
		'price',
		'quantity',
		'payment_plan_type_id'
	];

	public function payment_plan_type()
	{
		return $this->belongsTo(PaymentPlanType::class);
	}

	public function space_booking()
	{
		return $this->belongsTo(SpaceBooking::class, 'space_reservation_id');
	}
}
