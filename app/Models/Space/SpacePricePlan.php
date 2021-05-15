<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SpacePricePlan
 * 
 * @property int $id
 * @property int $space_id
 * @property int $payment_plan_type_id
 * @property bool $active
 * @property float $price
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property PaymentPlanType $payment_plan_type
 * @property Space $space
 * @property \Illuminate\Database\Eloquent\Collection $space_bookings
 *
 * @package App\Models
 */
class SpacePricePlan extends Eloquent
{
	protected $casts = [
		'space_id' => 'int',
		'payment_plan_type_id' => 'int',
		'active' => 'bool',
		'price' => 'float'
	];

	protected $fillable = [
		'space_id',
		'payment_plan_type_id',
		'active',
		'price'
	];

	public function payment_plan_type()
	{
		return $this->belongsTo(PaymentPlanType::class);
	}

	public function space()
	{
		return $this->belongsTo(Space::class);
	}
}
