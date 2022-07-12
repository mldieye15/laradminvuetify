<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->string('libelle', 255)->unique('uq_lib_club');
            $table->string('sigle',20)->unique('uq_sigle_club');
            $table->foreignId('ligue_regionale_id')->constrained('ligue_regionales')->onDelete('cascade');
            $table->boolean('visible')->default(1);
            $table->string('email')->unique('uq_email_club');
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
        Schema::dropIfExists('clubs');
    }
}
