<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class BusinessVertical
 * 
 * @property int $id
 * @property string $name
 * 
 * @property \Illuminate\Database\Eloquent\Collection $services
 * @property \Illuminate\Database\Eloquent\Collection $spaces
 *
 * @package App\Models
 */
class BusinessVertical extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function services()
	{
		return $this->hasMany(Service::class, 'service_type_id');
	}

	public function spaces()
	{
		return $this->hasMany(Space::class);
	}
}
