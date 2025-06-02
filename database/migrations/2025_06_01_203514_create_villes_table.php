<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('villes', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->timestamps();
        });

        // Ajout des principales villes du Maroc
        \DB::table('villes')->insert([
            ['nom' => 'Casablanca'],
            ['nom' => 'Rabat'],
            ['nom' => 'Marrakech'],
            ['nom' => 'Fès'],
            ['nom' => 'Tanger'],
            ['nom' => 'Agadir'],
            ['nom' => 'Meknès'],
            ['nom' => 'Oujda'],
            ['nom' => 'Kenitra'],
            ['nom' => 'Tétouan'],
            ['nom' => 'Salé'],
            ['nom' => 'Mohammedia'],
            ['nom' => 'Béni Mellal'],
            ['nom' => 'Khouribga'],
            ['nom' => 'El Jadida'],
            ['nom' => 'Safi'],
            ['nom' => 'Taza'],
            ['nom' => 'Larache'],
            ['nom' => 'Settat'],
            ['nom' => 'Berrechid']
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('villes');
    }
};
