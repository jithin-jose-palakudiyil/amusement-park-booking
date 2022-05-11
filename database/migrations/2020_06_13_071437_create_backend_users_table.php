<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBackendUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('backend_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('email',255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('password',255)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('image',255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->tinyInteger('status')->comment('0-inactive , 1-active')->nullable(false);
            $table->tinyInteger('is_developer')->comment('0-admin , 1-developer')->nullable(false)->default('0'); 
            $table->rememberToken();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('backend_users');
    }
}
