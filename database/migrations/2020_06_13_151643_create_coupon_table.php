<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('coupon_code',255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('offer',255)->collation('utf8mb4_unicode_ci')->default(0)->nullable(false); 
            $table->string('type',255)->collation('utf8mb4_unicode_ci')->comment('flat  , percentage ')->nullable(false); 
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
        Schema::dropIfExists('coupon');
    }
}
