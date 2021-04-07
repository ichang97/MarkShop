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
            $table->char('product_name', 100);
            $table->char('product_code', 20);
            $table->longtext('product_desc');
            $table->float('price',10,2);
            $table->longtext('product_img');
            $table->integer('product_type');
            $table->timestamps();

            $table->index('id'); $table->index('product_type');
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
