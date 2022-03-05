<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string("logo")->nullable();
            $table->string("slider_background")->nullable();
            $table->string("favicon")->nullable();
            $table->string("site_name")->nullable();
            $table->float("shipping_charge",11,2)->default(0);
            $table->float("tax",11,2)->default(0);
            $table->string("title")->nullable();
            $table->string("copyright")->nullable();
            $table->string("loader")->nullable();
            $table->string('currency')->nullable();
            $table->string('default_image')->nullable();
            $table->string("company_address")->nullable();
            $table->text("description")->nullable();
            $table->text("company_phone")->nullable();
            $table->text("company_email")->nullable();
            $table->text("facebook")->nullable();
            $table->text("instrgram")->nullable();
            $table->text("youtube")->nullable();
            $table->text("twitter")->nullable();
            $table->text("linkedin")->nullable();
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
        Schema::dropIfExists('general_settings');
    }
}
