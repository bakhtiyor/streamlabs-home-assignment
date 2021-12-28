<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('streams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->string('game');
            $table->string('viewers');
            $table->datetime('start_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('streams', function (Blueprint $table) {
            //
        });
    }
};
