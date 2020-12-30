<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoTexts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->text('seo_text')->nullable();
        });
        Schema::table('galleries', function (Blueprint $table) {
            $table->text('seo_text')->nullable();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->text('seo_text')->nullable();
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->text('seo_text')->nullable();
        });
        Schema::table('articles', function (Blueprint $table) {
            $table->text('seo_text')->nullable();
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
            $table->dropColumn('seo_text');
        });
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn('seo_text');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('seo_text');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('seo_text');
        });
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('seo_text');
        });
    }
}
