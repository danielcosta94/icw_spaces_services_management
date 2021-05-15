<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use App\User;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ServiceBooking
 * 
 * @property int $id
 * @property int $user_client_id
 * @property int $service_price_plan_id
 * @property string $payment_stripe_id
 * @property \Carbon\Carbon $date_reservation
 * @property string $status_reservation
 * @property int $quantity
 * @property float $price_unit
 * @property int $discount
 * @property string $currency
 * @property \Carbon\Carbon $date_cancellation
 * 
 * @property ServicePricePlan $service_price_plan
 * @property User $user
 *
 * @package App\Models
 */
class ServiceBooking extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'user_client_id' => 'int',
		'quantity' => 'int',
		'price_unit' => 'float',
		'discount' => 'int'
	];

	protected $dates = [
		'date_reservation',
		'date_cancellation'
	];

	protected $fillable = [
		'user_client_id',
        'service_id',
		'service_price_plan',
		'payment_stripe_id',
		'date_reservation',
		'status_reservation',
		'quantity',
		'price_unit',
		'discount',
		'currency',
		'date_cancellation'
	];

	public function service()
	{
		return $this->belongsTo(Service::class, 'service_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'user_client_id');
	}
}
