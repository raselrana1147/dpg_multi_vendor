<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraws', function (Blueprint $table) {
           $table->id();
           $table->unsignedBigInteger('seller_id')->nullable();
           $table->float('withdraw_amount',8,2);
           $table->string('account_holder_name');
           $table->string('account_number');
           $table->string('bank_name');
           $table->string('branch_name');
           $table->float('fee',8,2)->default(0);
           $table->text('note')->nullable();
           $table->text('comment')->nullable();
           $table->enum('status',['pending','accept','reject'])->default('pending');
           $table->string('type');
           $table->timestamps();
           $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdraws');
    }
}
