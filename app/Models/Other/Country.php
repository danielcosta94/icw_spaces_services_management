<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Country
 * 
 * @property string $code
 * @property string $name
 * @property string $currency_code
 * @property string $calling_code_id
 * @property string $flag_path
 * 
 * @property Currency $currency
 *
 * @package App\Models
 */
class Country extends Eloquent
{
	protected $primaryKey = 'code';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
	    'code',
		'name',
		'currency_code',
		'calling_code_id',
		'flag_path'
	];

	public function currency()
	{
		return $this->belongsTo(Currency::class, 'currency_code');
	}
}
