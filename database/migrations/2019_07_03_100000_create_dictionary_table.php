<?php

/*
 * This file is part of the bertshang/dictionary.
 *
 * (c) bertshang <359352960@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDictionaryTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('dicttypes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 64)->unique();
            $table->integer('status');
            $table->integer('sort');
            $table->timestamps();
        });

        Schema::create('dicttags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 128)->unique();
            $table->integer('dicttype_id');
            $table->integer('user_id');
            $table->integer('status');
            $table->integer('sort');
            $table->timestamps();
        });

        Schema::create('dictinfos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value', 128)->unique();
            $table->integer('dicttag_id');
            $table->integer('dicttype_id');
            $table->integer('user_id');
            $table->integer('status');
            $table->integer('sort');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('dicttypes');
        Schema::dropIfExists('dicttags');
        Schema::dropIfExists('dictinfos');
    }
}
