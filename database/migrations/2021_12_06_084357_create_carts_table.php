<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id('id');
            $table->string('ip_address')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->float('coupon_amount',11,2)->nullable();
            $table->tinyinteger('coupon_type')->nullable()->comment('0=flat,1=%');
            $table->unsignedBigInteger('size_id')->nullable();
            $table->unsignedBigInteger('color_id')->nullable();
            $table->integer('quantity');
            $table->tinyinteger('is_flash_deal')->default('0')->comment("0=yes,1=no");
            $table->float('flash_deal_amount',11,2)->nullable();
            $table->tinyinteger('flash_deal_type')->nullable()->comment('0=flat,1=%');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('carts');
    }
}
