<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePratiquantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pratiquants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personne_id')->constrained('personnes')->onDelete('cascade');
            $table->foreignId('fonction_pratiquant_id')->constrained('fonction_pratiquants')->onDelete('cascade');
            $table->foreignId('cote_pratiquant_id')->constrained('cote_pratiquants')->onDelete('cascade');
            $table->string('ins',5)->unique('uq_ins');
            $table->boolean('active')->default(true);
            //$table->unsignedBigInteger('personne_id');
            //$table->foreign('personne_id')->references('id')->on('personnes')->onDelete('cascade');

            

            $table->unique(['ins', 'personne_id'], 'uq_personne_ins');
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
        Schema::dropIfExists('pratiquants');
    }
}
