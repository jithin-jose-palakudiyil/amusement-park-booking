<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group',255)->collation('utf8mb4_unicode_ci')->nullable(false); 
            $table->string('name',255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('offer',255)->collation('utf8mb4_unicode_ci')->default(0)->nullable(false); 
            $table->tinyInteger('status')->comment('0-inactive , 1-active')->default(0)->nullable(false);
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
        Schema::dropIfExists('offers');
    }
}
