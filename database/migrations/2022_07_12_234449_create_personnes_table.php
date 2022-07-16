<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnes', function (Blueprint $table) {
            $table->id();
            $table->string('prenoms', 60);
            $table->string('nom', 60);
            //$table->string('sexe')->default('Homme');
            $table->enum('sexe', ['HOMME', 'FEMME'])->default('HOMME');
            $table->string('surnom', 15)->nullable();
            $table->string('taille',6)->nullable();
            $table->string('poids', 9)->nullable();
            $table->string('fonction',60);
            $table->boolean('ne_vers')->default(0);
            $table->date('date_naiss');
            $table->string('lieu_naiss',60);
            $table->string('adresse',255);
            $table->string('telephone',20);
            $table->string('civilite')->default('Célibataire');
            $table->text('photo')->nullable();
            $table->string('email')->nullable();
            //$table->string('type_piece_ident')->unique()->nullable();   // CIN, PASSPORT, APPRENANT, PROFESSIONNEL
            $table->enum('type_piece_ident', ['CIN', 'PASSPORT', 'APPRENANT', 'PROFESSIONNEL'])->default('CIN');
            $table->string('piece_ident')->nullable();
            $table->string('annee_naiss',4)->nullable();
            $table->string('ne_vers_naiss',60)->nullable();
            $table->string('cin')->nullable();
            $table->string('passport')->nullable();
            $table->string('page_web')->nullable();
            $table->string('facebook')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('telegram')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();
            $table->boolean('active')->default(true);

            $table->unsignedBigInteger('pays_naiss');
            $table->foreign('pays_naiss')->references('id')->on('pays');
            $table->unsignedBigInteger('pays_natio');
            $table->foreign('pays_natio')->references('id')->on('pays');

            $table->unique(['prenoms', 'nom', 'date_naiss', 'lieu_naiss', 'ne_vers', 'sexe' ], 'uq1_personne');
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
        Schema::dropIfExists('personnes');
    }
}
