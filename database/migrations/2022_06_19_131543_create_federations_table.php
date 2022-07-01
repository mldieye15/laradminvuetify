<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFederationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('federations', function (Blueprint $table) {
            $table->id();
            $table->string('libelle', 255)->unique('uq_lib_fede');
            $table->string('sigle',20)->unique('uq_sigle_fede');
            $table->foreignId('sport_id')->constrained('sports')->onDelete('cascade');
            $table->foreignId('pays_id')->constrained('pays')->onDelete('cascade');
            $table->boolean('visible')->default(0);
            $table->string('email')->unique('uq_email_fede');
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
            $table->unique(['pays_id', 'sport_id']);
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
        Schema::dropIfExists('federations');
    }
}
