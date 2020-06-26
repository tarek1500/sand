<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'date', 'work_time', 'absence_time', 'defective_time', 'user_id'
	];

	/**
	 * Many to one relation to the user.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}