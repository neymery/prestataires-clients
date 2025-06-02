<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('conversations', function (Blueprint $table) {
            $table->integer('unread_count')->default(0)->after('latest_message_id');
        });
    }

    public function down()
    {
        Schema::table('conversations', function (Blueprint $table) {
            $table->dropColumn('unread_count');
        });
    }
};
