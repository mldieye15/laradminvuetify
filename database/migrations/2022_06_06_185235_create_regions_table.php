<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('libelle', 50);  // Région de Dakar
            $table->string('sigle',30);  // Dakar
            $table->string('codification',10)->nullable();  // DK
            $table->string('indicatif',10)->nullable(); //
            $table->boolean('visible')->default(0);
            $table->text('map')->nullable();
            $table->foreignId('pays_id')->constrained('pays')->onDelete('cascade');
            $table->unique(['pays_id', 'libelle']) ;
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
        Schema::dropIfExists('regions');
    }
}
