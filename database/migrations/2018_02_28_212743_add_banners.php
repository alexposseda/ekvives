<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBanners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('banner')->nullable();
        });
        Schema::table('galleries', function (Blueprint $table) {
            $table->string('banner')->nullable();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->string('banner')->nullable();
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->string('banner')->nullable();
        });
        Schema::table('articles', function (Blueprint $table) {
            $table->string('banner')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('banner');
        });
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn('banner');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('banner');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('banner');
        });
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('banner');
        });
    }
}
