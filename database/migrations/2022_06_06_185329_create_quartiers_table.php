<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuartiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quartiers', function (Blueprint $table) {
            $table->id();
            $table->string('libelle', 40);
            $table->string('sigle',20)->nullable();
            $table->string('codification',10)->nullable();
            $table->string('indicatif',10)->nullable();
            $table->boolean('visible')->default(0);
            $table->text('map')->nullable();
            $table->foreignId('commune_id')->constrained('communes');
            $table->unique(['commune_id', 'libelle']) ;
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
        Schema::dropIfExists('quartiers');
    }
}
