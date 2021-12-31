<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('user_streams', function (Blueprint $table) {
            $table->integer('user_id');
            $table->bigInteger('stream_id');

            $table->unique(['user_id', 'stream_id']);
            $table->index('user_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_streams');
    }
};
