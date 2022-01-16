<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilisateursGroupesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilisateurs_groupes', function (Blueprint $table) {
             $table->id();
             $table->string('utilisateur_email');
             $table->string('groupe_nom');
             $table->foreign('utilisateur_email')->references('email')->on('utilisateurs')
                 ->onDelete('cascade');
             $table->foreign('groupe_nom')->references('nom')->on('groupes')
                 ->onDelete('cascade');
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
        Schema::dropIfExists('utilisateurs_groupes');
    }
}
