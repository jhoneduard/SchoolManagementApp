<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesNotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities_notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('qualification');
            $table->dateTime('date_upload_activity', 0);
            $table->string('url_document', 1000);
            $table->string('comment', 300);
            $table->bigInteger('id_register')->unsigned();

            $table->foreign('id_register')
            ->references('id')
            ->on('registration_subjects')
            ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities_notes');
    }
}
