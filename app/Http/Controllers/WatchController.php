<?php

namespace App\Http\Controllers;

use App\Functionality;
use App\Image;
use App\Watch;
use App\Brand;
use App\CaseMaterial;
use App\Condition;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class WatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $watches = Watch::orderBy('id', 'desc')->paginate(12);
		return view('watches.index', ['watches' => $watches]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    $brands = Brand::all();
	    $case_materials = CaseMaterial::all();
	    $conditions = Condition::all();
	    $functionalities = Functionality::all();
	    return view('watches.create', [
	    	'brands' => $brands,
		    'case_materials' => $case_materials,
		    'conditions' => $conditions,
		    'functionalities' => $functionalities
	    ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $now = Carbon::now();
	    $custom_validation_fails = false;

	    $rules = [
		    'brand_id' => 'required',
		    'model' => 'required|max:64',
		    'case_size' => 'required|integer|min:0',
		    'case_material_id' => 'required',
		    'bracelet' => 'required',
		    'year' => 'integer|min:0|nullable',
		    'price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
		    'condition_id' => 'required',
		    'images' => 'required|array|min:1|max:6'
	    ];

	    $messages = [
	    	'brand_id.required' => 'Please select a brand',
		    'case_material_id.required' => 'Please select a case material',
		    'condition_id.required' => 'Please select a condition'
	    ];

	    $validator = Validator::make($request->all(), $rules, $messages);

	    $images_array = array();
	    foreach ($request->images as $i => $image_url) {
		    if(!empty(trim($image_url))) {
			    $images_array[] = $image_url;
		    }
	    }

	    if($request->condition_id) {
		    $condition = Condition::where('id', $request->condition_id)->first();

		    if($condition->name === 'Vintage' && $request->price > 50000) {
			    $custom_validation_fails = true;
			    $errors[] = 'A vintage watch cannot cost more than 50000 Euro';
		    }
		    if(($condition->name !== 'Vintage' || $condition->name === 'AAA') && $request->year && $request->year + 20 < $now->year) {
			    $custom_validation_fails = true;
			    $errors[] = 'A watch which is older than 20 years can only be vintage or aaa';
		    }
		    if($condition->name === 'New' && $request->year && $request->year + 4 < $now->year) {
			    $custom_validation_fails = true;
			    $errors[] = 'A new watch cannot be older than 4 years';
		    }
		    if(empty($images_array)) {
			    $custom_validation_fails = true;
			    $errors[] = 'Please insert at least one image url';
		    }
		    if($request->year > $now->year) {
			    $custom_validation_fails = true;
			    $errors[] = 'A watch from the future('.$request->year.') can not be added';
		    }
	    }

	    if ($validator->fails()) {
		    return redirect(route('watches.create'))
			    ->withErrors($validator)
			    ->withInput();
	    } elseif ($custom_validation_fails) {
		    return redirect(route('watches.create'))
			    ->withErrors($errors)
			    ->withInput();
	    } else {
		    $brand = Brand::where('id', $request->brand_id)->first();
		    $sku = strtoupper(mb_substr($request->model, 0, 3)).Carbon::now()->format('YmdHis');
		    $url_slug = $brand->name.'-'.$request->model.'-'.$sku;

		    $images = json_encode($images_array);

		    $id = Watch::create([
			    'brand_id' => $request->brand_id,
			    'model' => $request->model,
			    'case_size' => $request->case_size,
			    'case_material_id' => $request->case_material_id,
			    'bracelet' => $request->bracelet,
			    'year' => $request->year,
			    'price' => $request->price,
			    'sku' => $sku,
			    'condition_id' => $request->condition_id,
			    'images' => $images,
			    'url_slug' => str_slug($url_slug)
		    ])->id;

		    $watch = Watch::where('id', $id)->first();

		    if($request->functionalities) {
			    foreach ($request->functionalities as $function_id) {
				    $function = Functionality::where('id', $function_id)->first();
				    $watch->functionalities()->attach($function);
			    }
		    }

		    return redirect(route('watches.index'));
	    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Watch  $watch
     * @return \Illuminate\Http\Response
     */
    public function show(Watch $watch)
    {
		return view('watches.show', ['watch' => $watch]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Watch  $watch
     * @return \Illuminate\Http\Response
     */
    public function edit(Watch $watch)
    {
	    $brands = Brand::all();
	    $case_materials = CaseMaterial::all();
	    $conditions = Condition::all();
	    $functionalities = Functionality::all();
	    return view('watches.edit', [
	    	'watch' => $watch,
		    'brands' => $brands,
		    'case_materials' => $case_materials,
		    'conditions' => $conditions,
		    'functionalities' => $functionalities
	    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Watch  $watch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Watch $watch)
    {
	    $now = Carbon::now();
	    $custom_validation_fails = false;

	    $rules = [
		    'brand_id' => 'required',
		    'model' => 'required|max:64',
		    'case_size' => 'required|integer|min:0',
		    'case_material_id' => 'required',
		    'bracelet' => 'required',
		    'year' => 'integer|min:0|nullable',
		    'price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
		    'condition_id' => 'required',
		    'images' => 'required|array|min:1|max:6'
	    ];

	    $messages = [
		    'brand_id.required' => 'Please select a brand',
		    'case_material_id.required' => 'Please select a case material',
		    'condition_id.required' => 'Please select a condition'
	    ];

	    $validator = Validator::make($request->all(), $rules, $messages);

	    $images_array = array();
	    foreach ($request->images as $i => $image_url) {
		    if(!empty(trim($image_url))) {
			    $images_array[] = $image_url;
		    }
	    }

	    if($request->condition_id) {
		    $condition = Condition::where('id', $request->condition_id)->first();

		    if($condition->name === 'Vintage' && $request->price > 50000) {
			    $custom_validation_fails = true;
			    $errors[] = 'A vintage watch cannot cost more than 50000 Euro';
		    }
		    if(($condition->name !== 'Vintage' || $condition->name === 'AAA') && $request->year && $request->year + 20 < $now->year) {
			    $custom_validation_fails = true;
			    $errors[] = 'A watch which is older than 20 years can only be vintage or aaa';
		    }
		    if($condition->name === 'New' && $request->year && $request->year + 4 < $now->year) {
			    $custom_validation_fails = true;
			    $errors[] = 'A new watch cannot be older than 4 years';
		    }
		    if(empty($images_array)) {
			    $custom_validation_fails = true;
			    $errors[] = 'Please insert at least one image url';
		    }
		    if($request->year > $now->year) {
			    $custom_validation_fails = true;
			    $errors[] = 'A watch from the future('.$request->year.') can not be added';
		    }
	    }

	    if ($validator->fails()) {
		    return redirect(route('watches.edit', $watch->id))
			    ->withErrors($validator)
			    ->withInput();
	    } elseif ($custom_validation_fails) {
		    return redirect(route('watches.edit', $watch->id))
			    ->withErrors($errors)
			    ->withInput();
	    } else {
		    $images = json_encode($images_array);

		    $watch->brand_id = $request->brand_id;
		    $watch->model = $request->model;
		    $watch->case_size = $request->case_size;
		    $watch->case_material_id = $request->case_material_id;
		    $watch->bracelet = $request->bracelet;
		    $watch->year = $request->year;
		    $watch->price = $request->price;
		    $watch->condition_id = $request->condition_id;
		    $watch->images = $images;
		    $watch->save();

		    $watch->functionalities()->detach();
		    if($request->functionalities) {
			    foreach ($request->functionalities as $function_id) {
				    $function = Functionality::where('id', $function_id)->first();
				    $watch->functionalities()->attach($function);
			    }
		    }

		    session()->flash('message', 'You have succesfully updated the watch details');
		    return redirect(route('watches.edit', $watch->id));
	    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Watch  $watch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Watch $watch)
    {
        $watch->delete();
	    $watch->functionalities()->detach();
        return redirect(route('watches.index'));
    }

    public function filter(Request $request) {
	    $watch = Watch::where('sku', $request->sku)->first();
	    return view('watches.show', ['watch' => $watch]);
    }

	public function urlslug($url_slug) {
    	$url_slug_array = explode('-', $url_slug);
    	$sku = end($url_slug_array);
		$watch = Watch::where('sku', $sku)->first();
		return view('watches.show', ['watch' => $watch]);
	}
}
