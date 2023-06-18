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
            $table->bigIncrements('id');	
            $table->string('name',35);
        });
        
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');	
            $table->bigInteger('identification')->unsigned()->unique();
            $table->string('document_type',5);
            $table->string('names', 50);
            $table->string('surnames', 50);
            $table->string('email', 60)->unique();
            $table->string('phone',20);
            $table->string('password');
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
