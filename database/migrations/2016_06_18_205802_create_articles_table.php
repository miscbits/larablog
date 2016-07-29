<?php

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
			$table->text('title');
			$table->text('body');
			$table->integer('user_id');
			$table->dateTime('created_at');
			$table->dateTime('updated_at');
			$table->boolean('publish');
			$table->boolean('deleted');
			$table->date('published_at');
			$table->string('subtitle');

            $table->string('title', 50);
            $table->text('body');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
