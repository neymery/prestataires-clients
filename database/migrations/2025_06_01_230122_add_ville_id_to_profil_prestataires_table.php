<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('profil_prestataires', function (Blueprint $table) {
            $table->foreignId('ville_id')->nullable()->after('disponible');
            $table->foreign('ville_id')->references('id')->on('villes')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('profil_prestataires', function (Blueprint $table) {
            $table->dropForeign(['ville_id']);
            $table->dropColumn('ville_id');
        });
    }
};
