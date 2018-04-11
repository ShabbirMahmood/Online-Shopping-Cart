<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('title')->nullable(false);
            $table->string('code',100)->unique()->nullable(false);
            $table->text('description')->nullable(false);
            $table->unsignedInteger('price')->nullable(false);
            $table->string('imagePath')->nullable(false);
            $table->string('category',150)->nullable(false);
            $table->unsignedInteger('stock')->nullable(false);
            $table->timestamps();
            $table->foreign('category')->references('category')->on('categories');
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
