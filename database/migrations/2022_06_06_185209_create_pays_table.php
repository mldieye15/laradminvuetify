<?php

use App\Models\Localisation\Continent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->id();
            $table->string('libelle', 80)->unique('uq_lib_pays');
            $table->string('sigle',40);
            $table->string('code_alpha2',2)->nullable();
            $table->string('code_alpha3',3)->nullable();
            $table->string('indicatif',10)->unique('uq_indicatif_pays');
            $table->boolean('visible')->default(0);
            $table->text('flag')->nullable();
            $table->text('map')->nullable();
            $table->foreignIdFor(Continent::class);
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
        Schema::dropIfExists('pays');
    }
}
