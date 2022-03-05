<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
              $table->id();
              $table->unsignedBigInteger('seller_id')->nullable();
              $table->unsignedBigInteger('order_id');
              $table->unsignedBigInteger('product_id');
              $table->unsignedBigInteger('size_id')->nullable();
              $table->unsignedBigInteger('color_id')->nullable();
              $table->integer('product_quantity');
              $table->tinyinteger('is_flash_deal')->default('0')->comment("0=yes,1=no");
              $table->float('flash_deal_amount',8,2)->nullable()->comment('flash is counted as %');
              $table->tinyInteger('status')->default('1')->comment('0=delivered,2=not delivered');
              $table->timestamps();
              $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
              $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
              $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
              $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
              $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
