<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Currency
 * 
 * @property string $code
 * @property string $name
 * @property string $symbol
 * 
 * @property \Illuminate\Database\Eloquent\Collection $countries
 *
 * @package App\Models
 */
class Currency extends Eloquent
{
	protected $primaryKey = 'code';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
        'code',
		'name',
		'symbol'
	];

	public function countries()
	{
		return $this->hasMany(Country::class, 'currency_code');
	}
}
