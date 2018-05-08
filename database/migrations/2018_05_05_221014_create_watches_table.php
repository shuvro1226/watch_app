<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watches', function (Blueprint $table) {
            $table->increments('id');
	        $table->integer('brand_id');
	        $table->string('model', 64);
	        $table->integer('case_size');
	        $table->integer('case_material_id');
	        $table->text('bracelet');
	        $table->integer('year');
	        $table->float('price');
	        $table->text('sku');
	        $table->integer('condition_id');
	        $table->text('images');
	        $table->text('url_slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('watches');
    }
}
