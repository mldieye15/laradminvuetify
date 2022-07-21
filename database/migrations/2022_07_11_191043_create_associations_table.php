<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associations', function (Blueprint $table) {
            $table->id();
            $table->string('libelle', 255);
            $table->string('sigle',20);
            $table->foreignId('ligue_regionale_id')->constrained('ligue_regionales')->onDelete('cascade');
            $table->boolean('visible')->default(1);
            $table->string('email');
            $table->string('adresse', 255);
            $table->string('telephone',20);
            $table->text('logo')->nullable();
            $table->string('sologan', 255)->nullable();
            $table->string('fax',20)->nullable();
            $table->string('date_creation')->nullable();
            $table->text('recipisse_numero')->nullable();
            $table->text('recipisse_date')->nullable();
            $table->text('recipisse_url')->nullable();
            $table->text('reglement_int_url')->nullable();
            $table->string('page_web')->nullable();
            $table->string('facebook')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('telegram')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();
            $table->foreignId('type_structure_id')->constrained('type_structures')->onDelete('cascade');
            $table->unique(['ligue_regionale_id', 'libelle']);
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
        Schema::dropIfExists('associations');
    }
}
