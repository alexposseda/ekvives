<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->text('photos')->nullable();
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
        Schema::dropIfExists('galleries');
    }
}
