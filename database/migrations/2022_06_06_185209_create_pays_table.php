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
            $table->string('libelle', 80)->unique('uq_lib_pays');   //  R2publique du Sénégal affiché dans les documents administratifs
            $table->string('sigle',40)->nullable(); //  Séngal
            $table->string('code_alpha2',2)->nullable();    // sn
            $table->string('code_alpha3',3)->nullable();    // sen
            $table->string('indicatif',10)->nullable(); ;    // 221
            $table->boolean('visible')->default(1);
            $table->text('flag')->nullable();
            $table->text('map')->nullable();
            $table->foreignIdFor(Continent::class)->onDelete('cascade') ;
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
