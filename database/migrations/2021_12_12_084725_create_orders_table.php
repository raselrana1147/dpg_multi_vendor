<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
           $table->id();
           $table->unsignedBigInteger('user_id')->nullable();
           $table->text('shipping_detail');
           $table->integer('quantity');
           $table->float('sub_total', 8, 2);
           $table->float('tax', 4, 2);
           $table->float('shipping_charge', 8, 2);
           $table->float('grand_total',8,2);
           $table->string('order_number');
           $table->string('payment_method');
           $table->mediumText('order_note')->nullable();
           $table->enum('status', ['pending', 'processing','confirmed','delivered','declined'])->default('pending');
           $table->timestamps();
           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
