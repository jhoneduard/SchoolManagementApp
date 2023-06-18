<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_user', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned();
            $table->string('name',35);
            $table->primary('id');
        });
        
        Schema::create('users', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned();
            $table->string('document_type',5);
            $table->string('names');
            $table->string('surnames',25);
            $table->string('email', 20)->unique();
            $table->string('password');
            $table->string('phone',15);
            $table->boolean('status')->default(false);
            $table->bigInteger('id_category')->unsigned();
            $table->foreign('id_category')
            ->references('id')
            ->on('category_user')
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
        Schema::dropIfExists('users');
    }
}
