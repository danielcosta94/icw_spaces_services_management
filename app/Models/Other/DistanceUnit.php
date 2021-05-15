<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class DistanceUnit
 * 
 * @property string $symbol
 * @property string $description
 * 
 * @property \Illuminate\Database\Eloquent\Collection $services
 *
 * @package App\Models
 */
class DistanceUnit extends Eloquent
{
	protected $primaryKey = 'symbol';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'description'
	];

	public function services()
	{
		return $this->hasMany(Service::class, 'distance_unit_symbol');
	}
}
