<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArgumentArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('argument_article', function (Blueprint $table) {
            $table->unsignedBigInteger('argument_id');
            $table->foreign('argument_id')->references('id')->on('arguments');

            $table->unsignedBigInteger('article_id');
            $table->foreign('article_id')->references('id')->on('articles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('argument_article');
    }
}
