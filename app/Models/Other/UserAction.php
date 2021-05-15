<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use App\User;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserAction
 * 
 * @property int $id
 * @property int $user_id
 * @property string $cookie_id
 * @property int $action_type_id
 * @property string $criteria
 * @property \Carbon\Carbon $datetime
 * 
 * @property ActionType $action_type
 * @property User $user
 *
 * @package App\Models
 */
class UserAction extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'action_type_id' => 'int'
	];

	protected $dates = [
		'datetime'
	];

	protected $fillable = [
		'user_id',
		'cookie_id',
		'action_type_id',
		'criteria',
		'datetime'
	];

	public function action_type()
	{
		return $this->belongsTo(ActionType::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
