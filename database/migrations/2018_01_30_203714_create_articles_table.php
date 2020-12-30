<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('content');
            $table->text('description')->nullable();
            $table->boolean('anchored')->default(0);
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->boolean('use_video')->default(0);
            $table->datetime('published_at');
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->boolean('no_index')->default(0);
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
        Schema::dropIfExists('articles');
    }
}
