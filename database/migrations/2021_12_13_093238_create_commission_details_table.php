<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
            $table->float('defined_commission',11,2)->nullable();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->tinyInteger('is_flash_deal')->default('0')->comment("0 is not, 1 is yes");
            $table->float('flash_deal_amount',11,2)->nullable()->comment('flash is counted as %');
            $table->float('unit_commission',11,2);
            $table->float('total_commission',11,2);
            $table->timestamps();
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commission_details');
    }
}
