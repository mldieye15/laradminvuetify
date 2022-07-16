<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserNatioSportIdentitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_natio_sport_identities', function (Blueprint $table) {
            $table->unsignedBigInteger('personne_id');
            $table->foreign('personne_id')->references('id')->on('personnes')->onDelete('cascade');

            $table->string('ins',5)->unique('uq_ins');

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
        Schema::dropIfExists('user_natio_sport_identities');
    }
}
