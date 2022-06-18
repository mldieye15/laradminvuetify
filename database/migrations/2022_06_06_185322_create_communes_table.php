<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communes', function (Blueprint $table) {
            $table->id();
            $table->string('libelle', 50);
            $table->string('sigle',30);
            $table->string('codification',10)->nullable();
            $table->string('indicatif',10)->nullable();
            $table->boolean('visible')->default(0);
            $table->text('map')->nullable();
            $table->foreignId('departement_id')->constrained('departements')->onDelete('cascade');
            $table->unique(['departement_id', 'libelle']) ;
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
        Schema::dropIfExists('communes');
    }
}
