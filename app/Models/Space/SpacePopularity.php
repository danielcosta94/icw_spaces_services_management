<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SpacePopularity
 * 
 * @property int $id
 * @property int $space_id
 * @property int $action_type_id
 * @property \Carbon\Carbon $created_at
 * 
 * @property ActionType $action_type
 * @property Space $space
 *
 * @package App\Models
 */
class SpacePopularity extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'space_id' => 'int',
		'action_type_id' => 'int'
	];

	protected $fillable = [
		'space_id',
		'action_type_id'
	];

	public function action_type()
	{
		return $this->belongsTo(ActionType::class);
	}

	public function space()
	{
		return $this->belongsTo(Space::class);
	}
}
