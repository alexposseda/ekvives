<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->text('address')->nullable();
            $table->text('email')->nullable();
            $table->text('phones')->nullable();
            $table->string('place_id')->nullable();
            $table->boolean('no_address')->default(0);
            $table->text('text')->nullable();
            $table->string('image')->nullable();
            $table->unsignedInteger('parent_id')->default(0)->nullable();
            $table->unsignedInteger('lft')->nullable();
            $table->unsignedInteger('rgt')->nullable();
            $table->unsignedInteger('depth')->nullable();

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
        Schema::dropIfExists('contacts');
    }
}
