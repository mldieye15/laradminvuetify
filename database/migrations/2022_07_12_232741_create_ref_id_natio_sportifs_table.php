<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefIdNatioSportifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_id_natio_sportifs', function (Blueprint $table) {
            $table->id();
            $table->integer('compteur')->default(0);
            $table->char('suffixe',2)->unique('uq_suffixe');
            $table->integer('codification')->default(0);
            $table->boolean('current')->default(0);
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
        Schema::dropIfExists('ref_id_natio_sportifs');
    }
}
