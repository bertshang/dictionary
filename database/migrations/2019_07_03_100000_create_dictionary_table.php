<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDictionaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dicttypes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 128)->unique();
            $table->integer('user_id');
            $table->integer('status');
            $table->integer('sort');
            $table->timestamps();
        });

        Schema::create('dictinfos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value', 128)->unique();
            $table->integer('dicttype_id');
            $table->integer('user_id');
            $table->integer('status');
            $table->integer('sort');
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
        Schema::dropIfExists('dicttype');
        Schema::dropIfExists('dictinfo');
    }
}
