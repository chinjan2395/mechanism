<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->integer('id', true, false);
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Schema::create('product_price', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('product_id')->nullable();
            $table->integer('amount')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('product');

            $table->engine = 'InnoDB';
        });

        Schema::create('product_quantity', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('product');

            $table->engine = 'InnoDB';
        });

        Schema::create('product_image', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->nullable();
            $table->char('img_1', '200')->nullable();
            $table->char('img_2', '200')->nullable();
            $table->char('img_3', '200')->nullable();
            $table->char('img_4', '200')->nullable();
            $table->char('img_5', '200')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('product');

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product');
        Schema::drop('product_price');
        Schema::drop('product_quantity');
        Schema::drop('product_image');
    }
}
