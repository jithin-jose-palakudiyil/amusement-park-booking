<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_booking', function (Blueprint $table)
        {
            $table->increments('id');
            $table->foreign('booking_id')->references('id')->on('booking')->onDelete('cascade');;
            $table->integer('booking_id')->unsigned(); 
            $table->foreign('category_id')->references('id')->on('category');
            $table->integer('category_id')->unsigned();
             $table->string('count',255)->collation('utf8mb4_unicode_ci')->nullable(false);
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
        Schema::dropIfExists('pivot_booking');
    }
}
