<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Functionality extends Model
{
	protected $fillable = [
		'name'
	];

	public function watches() {
		return $this->belongsToMany('App\Watch');
	}
}
