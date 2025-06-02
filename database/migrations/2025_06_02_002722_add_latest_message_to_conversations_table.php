<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('conversations', function (Blueprint $table) {
            $table->foreignId('latest_message_id')->nullable()->after('destinataire_id');
            $table->foreign('latest_message_id')->references('id')->on('messages')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('conversations', function (Blueprint $table) {
            $table->dropForeign(['latest_message_id']);
            $table->dropColumn('latest_message_id');
        });
    }
};
