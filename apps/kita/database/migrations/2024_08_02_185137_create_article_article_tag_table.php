<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleArticleTagTable extends Migration
{
/**
* Run the migrations.
*
* @return void
*/
public function up()
{
    Schema::create('article_article_tag', function (Blueprint $table) {
        $table->increments('id'); // INT UNSIGNED の primary key
        $table->unsignedInteger('article_id'); // articles テーブルの外部キー（INT UNSIGNED）
        $table->unsignedInteger('article_tag_id'); // article_tags テーブルの外部キー（INT UNSIGNED）
        $table->timestamps(); // 作成日時、更新日時

        // 外部キー制約を追加
        $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        $table->foreign('article_tag_id')->references('id')->on('article_tags')->onDelete('cascade');

        $table->unique(['article_id', 'article_tag_id']); // ユニーク制約
    });


}

/**
* Reverse the migrations.
*
* @return void
*/
public function down()
{
Schema::dropIfExists('article_article_tag');
}
}
