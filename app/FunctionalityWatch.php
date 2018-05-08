<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FunctionalityWatch extends Model
{
	protected $fillable = [
		'functionality_id',
		'watch_id'
	];
}
