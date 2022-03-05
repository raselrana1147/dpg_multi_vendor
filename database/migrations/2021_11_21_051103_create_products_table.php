<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->nullable();
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('product_type_id')->nullable();
            $table->unsignedBigInteger('sub_category_id');
            $table->unsignedBigInteger('brand_id');
            $table->float('purchase_price',11,2)->nullable();
            $table->float('previous_price',11,2)->nullable();
            $table->float('current_price',11,2);
            $table->float('discount',11,2)->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('video_link')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('slug')->unique();
            $table->string('tag')->nullable();
            $table->integer('view')->default(0);
            $table->integer('total_impression')->default(0);
            $table->integer('click')->default(0);
            $table->integer('total_order')->default(0);
            $table->timestamp('last_ordered_at')->nullable();
            $table->enum('stock_type',['limited','unlimited'])->nullable();
            $table->enum('sale_type',['whole','retail'])->default('retail');
            $table->integer('whole_sale_quantity')->default('10');
            $table->longText('description')->nullable();
            $table->longText('specification')->nullable();
            $table->longText('return_policy')->nullable();
            $table->tinyInteger('is_raw')->default('0')->comment('0=yes,1=no');
            $table->tinyInteger('allow_negetive_stock')->default('1')->comment('0=yes,1=no');
            $table->tinyInteger('flash_deal')->default('0')->comment('0=yes,1=no');
            $table->tinyInteger('featured')->default('0')->comment('0=yes,1=no');
            $table->tinyInteger('best_sale')->default('0')->comment('0=yes,1=no');
            $table->tinyInteger('hot')->default('0')->comment('0=yes,1=no');
            $table->tinyInteger('top_sale')->default('0')->comment('0=yes,1=not');
            $table->tinyInteger('big_save')->default('0')->comment('0=yes,1=now');
            $table->tinyInteger('new_arrival')->default('0')->comment('0=yes,1=no');
            $table->tinyInteger('trending')->default('0')->comment('0=yes,1=no');
            $table->tinyInteger('check_attributes')->default('0')->comment('0=yes,1=no');
            $table->timestamps();

            // propagration contrains
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_type_id')->references('id')->on('product_types')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('sub_category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
