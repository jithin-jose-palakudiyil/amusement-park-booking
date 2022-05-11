<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name',255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->text('address')->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('email',255)->collation('utf8mb4_unicode_ci')->nullable();
            
            $table->string('phone',255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('coupon_code',255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->foreign('coupon_id')->references('id')->on('coupon');
            $table->integer('coupon_id')->nullable()->unsigned();
            
            $table->foreign('offer_id')->references('id')->on('offers');
            $table->integer('offer_id')->nullable()->unsigned();
            
            $table->string('booking_date',255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('razorpay_order_id',255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('razorpay_payment_id',255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('razorpay_signature',255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('amount_paid',255)->collation('utf8mb4_unicode_ci')->nullable(false);
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
        Schema::dropIfExists('booking');
    }
}
