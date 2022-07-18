<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradePratiquantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_pratiquants', function (Blueprint $table) {
            $table->id();
            $table->string('libelle', 100);
            $table->string('sigle', 20);
            $table->integer('age_min')->default(2);
            $table->integer('age_max')->default(100);
            $table->boolean('active')->default(1);
            $table->integer('niveau');
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
        Schema::dropIfExists('grade_pratiquants');
    }
}
