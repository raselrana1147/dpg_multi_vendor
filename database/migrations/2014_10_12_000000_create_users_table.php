<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('full_name');
            $table->float('main_balance',11,2)->default(0);
            $table->float('pending_balance',11,2)->default(0);
            $table->unsignedBigInteger('display_id')->nullable();
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->unsignedBigInteger('referral_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('role_id')->default('1');
            $table->string('username')->unique()->nullable();
            $table->string('gender')->nullable();
            $table->string('password');
            $table->string('email')->unique()->nullable();
            $table->text('address')->nullable();
            $table->string('country_code')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('user_type')->nullable();
            $table->string('account_type')->nullable();
            $table->string('referral_code')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('account_verified_at')->nullable();
            $table->string('profile_image_url')->nullable();
            $table->string('banner_image_url')->nullable();
            $table->string('tag')->nullable();
            $table->string('shop_name')->nullable();
            $table->string('shop_logo')->nullable();
            $table->float('possitive_ratting',11,2)->default('0');
            $table->float('shipping_ratting',11,2)->default('0');
            $table->float('response_ratting',11,2)->default('0');
            $table->tinyInteger('is_tenant_admin')->default('0')->comment('0=no,1=yes');
            $table->tinyInteger('is_system_admin')->default('0')->comment('0=no,1=yes');
            $table->tinyInteger('is_verified')->default('0')->comment('0=no,1=yes');
            $table->tinyInteger('is_company_sale_profile')->default('0')->comment('0=no,1=yes');
            $table->float('default_service_charge')->nullable();
            $table->float('discount_on_service_charge')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('is_active')->default('1')->comment('0=inactive,1=active');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
