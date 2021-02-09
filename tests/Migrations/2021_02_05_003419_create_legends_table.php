<?php

use Tests\Fixtures\Models\Legend;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legends', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('occupation');
            $table->enum('class', Legend::classes());
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
        Schema::dropIfExists('legends');
    }
}
