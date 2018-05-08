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
    }
}
