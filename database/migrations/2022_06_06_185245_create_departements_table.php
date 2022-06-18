<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departements', function (Blueprint $table) {
            $table->id();
            $table->string('libelle', 50);
            $table->string('sigle',30)->nullable();
            $table->string('codification',10)->nullable();
            $table->string('indicatif',10)->nullable();
            $table->boolean('visible')->default(0);
            $table->text('map')->nullable();
            $table->foreignId('region_id')->constrained('regions')->onDelete('cascade');
            $table->unique(['region_id', 'libelle']) ;
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
        Schema::dropIfExists('departements');
    }
}
