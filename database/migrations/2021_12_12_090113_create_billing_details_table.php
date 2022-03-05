<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_details', function (Blueprint $table) {
           $table->id();
           $table->unsignedBigInteger('user_id');
           $table->unsignedBigInteger('order_id');
           $table->string('fname');
           $table->string('lname');
           $table->string('country');
           $table->string('city');
           $table->string('email');
           $table->string('phone');
           $table->string('postcode');
           $table->text('address');
           $table->timestamps();
           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('billing_details');
    }
}
