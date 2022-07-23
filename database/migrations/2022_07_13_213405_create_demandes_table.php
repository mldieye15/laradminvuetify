<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personne_id')->constrained('personnes')->onDelete('cascade');
            $table->foreignId('type_demande_id')->constrained('type_demandes')->onDelete('cascade');
            $table->foreignId('fonction_pratiquant_id')->constrained('fonction_pratiquants')->onDelete('cascade');
            $table->foreignId('cote_pratiquant_id')->constrained('cote_pratiquants')->onDelete('cascade');
            $table->foreignId('type_structure_id')->constrained('type_structures')->onDelete('cascade');
            $table->foreignId('club_id')->nullable()->constrained('clubs')->onDelete('cascade');
            $table->foreignId('centre_formation_id')->nullable()->constrained('centre_formations')->onDelete('cascade');
            $table->foreignId('association_id')->nullable()->constrained('associations')->onDelete('cascade');
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
