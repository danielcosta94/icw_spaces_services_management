<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PaymentPlanType
 * 
 * @property int $id
 * @property string $plan
 * 
 * @property \Illuminate\Database\Eloquent\Collection $service_price_plans
 * @property \Illuminate\Database\Eloquent\Collection $space_price_plans
 * @property \Illuminate\Database\Eloquent\Collection $space_reserved_extras
 *
 * @package App\Models
 */
class PaymentPlanType extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'plan'
	];

	public function service_price_plans()
	{
		return $this->hasMany(ServicePricePlan::class);
	}

	public function space_price_plans()
	{
		return $this->hasMany(SpacePricePlan::class);
	}

	public function space_reserved_extras()
	{
		return $this->hasMany(SpaceReservedExtra::class);
	}
}
