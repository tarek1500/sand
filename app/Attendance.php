<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'date', 'is_sign_in', 'user_id', 'is_processed'
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'date' => 'datetime',
		'is_sign_in' => 'boolean',
		'is_processed' => 'boolean'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}