<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use App\User;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ServiceReview
 * 
 * @property int $id
 * @property int $user_id
 * @property int $service_id
 * @property string $comment
 * @property int $rating
 * @property \Carbon\Carbon $commented_at
 * 
 * @property Service $service
 * @property User $user
 *
 * @package App\Models
 */
class ServiceReview extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'service_id' => 'int',
		'rating' => 'int'
	];

	protected $dates = [
		'commented_at'
	];

	protected $fillable = [
		'user_id',
		'service_id',
		'comment',
		'rating',
		'commented_at'
	];

	public function service()
	{
		return $this->belongsTo(Service::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
