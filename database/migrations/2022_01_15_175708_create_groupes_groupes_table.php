<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupesGroupesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupes_groupes', function (Blueprint $table) {
            $table->id();
            $table->string('groupeOne_nom');
            $table->string('groupetwo_nom');

            $table->foreign('groupeOne_nom')->references('nom')->on('groupes')
                ->onDelete('cascade');
            $table->foreign('groupetwo_nom')->references('nom')->on('groupes')
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
        Schema::dropIfExists('groupes_groupes');
    }
}
