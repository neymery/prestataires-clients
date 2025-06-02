<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('profil_prestataires', function (Blueprint $table) {
            $table->string('ville')->nullable()->after('bio');
        });
    }

    public function down()
    {
        Schema::table('profil_prestataires', function (Blueprint $table) {
            $table->dropColumn('ville');
        });
    }
};
