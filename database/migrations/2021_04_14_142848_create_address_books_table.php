<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_books', function (Blueprint $table) {
            $table->id();
            $table->string('address_name');
            $table->string('receiver_name');
            $table->string('home_number');
            $table->string('building_name')->nullable();
            $table->string('floor_no')->nullable();
            $table->string('street');
            $table->string('sub_district');
            $table->string('district');
            $table->string('province');
            $table->string('postal_code');
            $table->integer('member_id');
            $table->integer('default');
            $table->timestamps();

            $table->index('id');
            $table->index('member_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address_books');
    }
}
