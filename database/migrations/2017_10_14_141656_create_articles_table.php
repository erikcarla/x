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
            $table->text('body');
            $table->integer('media_id');
            $table->integer('user_id');
            $table->boolean('published')->default(false);
            $table->dateTime('publish_date')->nullable();
            $table->timestamps();

        });
        DB::statement('CREATE INDEX article_by_user ON articles (user_id)');
        DB::statement('CREATE INDEX article_by_published ON articles (published)');
        DB::statement('CREATE INDEX article_by_published_and_publish_date ON articles (published, publish_date)');
        DB::statement('CREATE INDEX article_by_user_and_publish_and_published_date ON articles (user_id, published, publish_date)');
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
