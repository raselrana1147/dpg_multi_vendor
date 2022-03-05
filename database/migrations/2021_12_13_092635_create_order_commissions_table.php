<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_commissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->float('sub_total',8,2);
            $table->float('tax',8,2);
            $table->float('charge',8,2);
            $table->float('grand_total',8,2);
            $table->float('seller_amount',11,2);
            $table->float('company_will_get',8,2);
            $table->timestamps();
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
        Schema::dropIfExists('order_commissions');
    }
}
