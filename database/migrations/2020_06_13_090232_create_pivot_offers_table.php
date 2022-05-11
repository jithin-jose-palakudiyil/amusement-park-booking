<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
            $table->integer('offer_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
            $table->integer('category_id')->unsigned(); 
            $table->string('actual_price',255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('offer_price',255)->collation('utf8mb4_unicode_ci')->nullable(false);
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
        Schema::dropIfExists('pivot_offers');
    }
}
