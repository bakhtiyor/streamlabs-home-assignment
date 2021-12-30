<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('tag_id', 36);
            $table->json('localization_names');
            $table->json('localization_descriptions');
            $table->timestamps();
            $table->unique('tag_id');
            $table->index('tag_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tags');
    }
};
