<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use App\User;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SpaceReview
 * 
 * @property int $id
 * @property int $user_id
 * @property int $space_id
 * @property string $comment
 * @property int $rating
 * @property \Carbon\Carbon $commented_at
 * 
 * @property Space $space
 * @property User $user
 *
 * @package App\Models
 */
class SpaceReview extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'space_id' => 'int',
		'rating' => 'int'
	];

	protected $dates = [
		'commented_at'
	];

	protected $fillable = [
		'user_id',
		'space_id',
		'comment',
		'rating',
		'commented_at'
	];

	public function space()
	{
		return $this->belongsTo(Space::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
