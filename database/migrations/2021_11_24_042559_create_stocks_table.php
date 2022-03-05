<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
           $table->id();
           $table->unsignedBigInteger('product_id');
           $table->unsignedBigInteger('color_id');
           $table->unsignedBigInteger('size_id');
           $table->integer('quantity');
           $table->timestamps();

           // propagration contrains
           $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
           $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
           $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
