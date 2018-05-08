<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
	    DB::table('brands')->insert([
	    	[ 'name' => 'Rolex', 'slug' => 'rolex', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
		    [ 'name' => 'A. Lange & Söhne', 'slug' => 'alangeandsohne', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
		    [ 'name' => 'IWC', 'slug' => 'iwc', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
		    [ 'name' => 'Breitling', 'slug' => 'breitling', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')]
	    ]);

	    DB::table('case_materials')->insert([
		    [ 'name' => 'Steel', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
		    [ 'name' => 'Titanium', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
		    [ 'name' => 'Ceramic', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')]
	    ]);

	    DB::table('functionalities')->insert([
		    [ 'name' => 'Chronograph', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
		    [ 'name' => 'Date', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
		    [ 'name' => 'Small second', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
		    [ 'name' => 'Moonphase', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
		    [ 'name' => 'Day date', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
		    [ 'name' => 'Perpetual calendar', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')]
	    ]);

	    DB::table('conditions')->insert([
		    [ 'name' => 'New', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
		    [ 'name' => 'AAA', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
		    [ 'name' => 'AA', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
		    [ 'name' => 'A', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
		    [ 'name' => 'Vintage', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')]
	    ]);

	    DB::table('watches')->insert([
			[
				'brand_id' => 1,
				'model' => 'Submariner Date',
				'case_size' => 40,
				'case_material_id' => 1,
				'bracelet' => 'Steel',
				'year' => 2014,
				'price' => 7090.00,
				'sku' => 'SUB20180508124903',
				'condition_id' => 2,
				'images' => '["https:\/\/chronexttime.imgix.net\/C\/7\/C77555\/C77555_5abb97600dd16.jpg","https:\/\/d5jcvr53fshg.cloudfront.net\/img\/Chronext-certificate-english.jpg"]',
				'url_slug' => 'rolex-submariner-date-sub20180508124903'
			],
		    [
			    'brand_id' => 1,
			    'model' => 'Datejust',
			    'case_size' => 36,
			    'case_material_id' => 1,
			    'bracelet' => 'Steel',
			    'year' => 1997,
			    'price' => 4280.00,
			    'sku' => 'DAT20180508125054',
			    'condition_id' => 5,
			    'images' => '["https:\/\/chronexttime.imgix.net\/M\/0\/M02437\/M02437_5aa0176be8b51.jpg","https:\/\/d5jcvr53fshg.cloudfront.net\/img\/Chronext-certificate-english.jpg"]',
			    'url_slug' => 'rolex-datejust-dat20180508125054'
		    ],
		    [
			    'brand_id' => 4,
			    'model' => 'Chronospace Evo Night Mission',
			    'case_size' => 43,
			    'case_material_id' => 1,
			    'bracelet' => 'Rubber',
			    'year' => 2017,
			    'price' => 3120.00,
			    'sku' => 'CHR20180508125550',
			    'condition_id' => 1,
			    'images' => '["https:\/\/chronexttime.imgix.net\/L\/3\/L33572\/L33572_5a6a01e64b022.jpg","https:\/\/d5jcvr53fshg.cloudfront.net\/img\/Chronext-certificate-english.jpg"]',
			    'url_slug' => 'breitling-chronospace-evo-night-mission-chr20180508125550'
		    ],
		    [
			    'brand_id' => 4,
			    'model' => 'Navitimer Cosmonaute',
			    'case_size' => 43,
			    'case_material_id' => 1,
			    'bracelet' => 'Leather',
			    'year' => 2017,
			    'price' => 5470.00,
			    'sku' => 'NAV20180508125350',
			    'condition_id' => 1,
			    'images' => '["https:\/\/chronexttime.imgix.net\/U\/3\/U3831\/U3831_58e22d979dac3.jpg","https:\/\/d5jcvr53fshg.cloudfront.net\/img\/Chronext-certificate-english.jpg"]',
			    'url_slug' => 'breitling-navitimer-cosmonaute-nav20180508125350'
		    ],
		    [
			    'brand_id' => 3,
			    'model' => 'Ingenieur AMG',
			    'case_size' => 46,
			    'case_material_id' => 3,
			    'bracelet' => 'Rubber',
			    'year' => 2015,
			    'price' => 5950.00,
			    'sku' => 'ING20180508125951',
			    'condition_id' => 2,
			    'images' => '["https:\/\/chronexttime.imgix.net\/1\/1\/11654\/11654_58651b7f5c6a1.jpg","https:\/\/d5jcvr53fshg.cloudfront.net\/img\/Chronext-certificate-english.jpg"]',
			    'url_slug' => 'iwc-ingenieur-amg-ing20180508125951'
		    ],
		    [
			    'brand_id' => 3,
			    'model' => 'Portofino Automatic',
			    'case_size' => 40,
			    'case_material_id' => 1,
			    'bracelet' => 'Leather',
			    'year' => 2018,
			    'price' => 3560.00,
			    'sku' => 'POR20180508130154',
			    'condition_id' => 1,
			    'images' => '["https:\/\/chronexttime.imgix.net\/0\/0\/004406\/004406-40b7ivCG.jpg","https:\/\/chronexttime.imgix.net\/0\/0\/004406\/Wristshoots-3381_result_582f60d4a68cd.jpg"]',
			    'url_slug' => 'iwc-portofino-automatic-por20180508130154'
		    ],
		    [
			    'brand_id' => 2,
			    'model' => 'Saxonia',
			    'case_size' => 39,
			    'case_material_id' => 1,
			    'bracelet' => 'Leather',
			    'year' => 2017,
			    'price' => 15900.00,
			    'sku' => 'SAX20180508130325',
			    'condition_id' => 2,
			    'images' => '["https:\/\/chronexttime.imgix.net\/M\/0\/M02618\/M02618_5adda799c39ec.jpg","https:\/\/d5jcvr53fshg.cloudfront.net\/img\/Chronext-certificate-english.jpg"]',
			    'url_slug' => 'a-lange-sohne-saxonia-sax20180508130325'
		    ],
		    [
			    'brand_id' => 2,
			    'model' => 'Lange 1 Zeitzone',
			    'case_size' => 41,
			    'case_material_id' => 2,
			    'bracelet' => 'Crocodile Leather',
			    'year' => 2017,
			    'price' => 32500.00,
			    'sku' => 'LAN20180508130457',
			    'condition_id' => 1,
			    'images' => '["https:\/\/chronexttime.imgix.net\/M\/0\/M02495\/M02495_5abb611fb9be2.jpg","https:\/\/d5jcvr53fshg.cloudfront.net\/img\/Chronext-certificate-english.jpg"]',
			    'url_slug' => 'a-lange-sohne-lange-1-zeitzone-lan20180508130457'
		    ]
	    ]);

	    DB::table('functionality_watch')->insert([
		    [ 'functionality_id' => 2, 'watch_id' => 1],
		    [ 'functionality_id' => 4, 'watch_id' => 1],
		    [ 'functionality_id' => 2, 'watch_id' => 2],
		    [ 'functionality_id' => 3, 'watch_id' => 2],
		    [ 'functionality_id' => 5, 'watch_id' => 3],
		    [ 'functionality_id' => 3, 'watch_id' => 4],
		    [ 'functionality_id' => 6, 'watch_id' => 4],
		    [ 'functionality_id' => 2, 'watch_id' => 5],
		    [ 'functionality_id' => 4, 'watch_id' => 5],
		    [ 'functionality_id' => 2, 'watch_id' => 6],
		    [ 'functionality_id' => 3, 'watch_id' => 6],
		    [ 'functionality_id' => 5, 'watch_id' => 7],
		    [ 'functionality_id' => 3, 'watch_id' => 8],
		    [ 'functionality_id' => 6, 'watch_id' => 8]
	    ]);
    }
}
