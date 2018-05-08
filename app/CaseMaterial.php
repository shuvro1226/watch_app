<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseMaterial extends Model
{
	protected $fillable = [
		'name'
	];

	public function watch() {
		return $this->hasMany('App\Watch');
	}
}
