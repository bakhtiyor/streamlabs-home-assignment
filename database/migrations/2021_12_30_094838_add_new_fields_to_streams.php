<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::dropIfExists('streams'); //removing old table, it was created for a test purpose with a test fields

        Schema::create('streams', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('user_login');
            $table->string('user_name');
            $table->integer('game_id')->nullable();
            $table->string('game_name');
            $table->string('type');
            $table->string('title');
            $table->integer('viewer_count');
            $table->dateTime('started_at');
            $table->char('language', 5);
            $table->string('thumbnail_url');
            $table->boolean('is_mature');
            $table->timestamps();
        });

        Schema::create('stream_tags', function (Blueprint $table) {
            $table->bigInteger('stream_id');
            $table->char('tag_id', 36);
            $table->index('stream_id');
            $table->unique(['stream_id', 'tag_id'], 'unique_records');
        });
    }

    public function down()
    {
        Schema::dropIfExists('streams');
        Schema::dropIfExists('stream_tags');
    }
};
