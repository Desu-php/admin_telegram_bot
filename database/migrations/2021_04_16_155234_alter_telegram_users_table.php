<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTelegramUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('telegram_users', function (Blueprint $table) {
            //
            $table->string('user_status')->nullable();
            $table->string('scam')->nullable();
            $table->string('resricted')->nullable();
            $table->string('restriction_reason')->nullable();
            $table->string('bot')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('telegram_users', function (Blueprint $table) {
            //
        });
    }
}
