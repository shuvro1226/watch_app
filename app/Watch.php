<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Watch extends Model
{
	protected $fillable = [
		'brand_id',
		'model',
		'case_size',
		'case_material_id',
		'bracelet',
		'year',
		'price',
		'sku',
		'condition_id',
		'images',
		'url_slug'
	];

	public function brand() {
		return $this->belongsTo('App\Brand', 'brand_id');
	}

	public function caseMaterial() {
		return $this->belongsTo('App\CaseMaterial');
	}

	public function condition() {
		return $this->belongsTo('App\Condition');
	}

	public function functionalities() {
		return $this->belongsToMany( 'App\Functionality' );
	}
}
