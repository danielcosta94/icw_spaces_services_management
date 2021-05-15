<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SpacePhoto
 * 
 * @property int $id
 * @property string $photo_type
 * @property int $space_id
 * @property string $path
 * @property \Carbon\Carbon $uploaded_at
 * 
 * @property Space $space
 *
 * @package App\Models
 */
class SpacePhoto extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'space_id' => 'int'
	];

	protected $dates = [
		'uploaded_at'
	];

	protected $fillable = [
		'photo_type',
		'space_id',
		'path',
		'uploaded_at'
	];

	public function space()
	{
		return $this->belongsTo(Space::class);
	}
}
