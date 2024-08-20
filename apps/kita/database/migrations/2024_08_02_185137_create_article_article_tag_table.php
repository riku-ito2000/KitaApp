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
        $table->id(); // 自動的に bigint の primary key
        $table->foreignId('article_id')->constrained('articles')->onDelete('cascade'); // articles テーブルの外部キー
        $table->foreignId('article_tag_id')->constrained('article_tags')->onDelete('cascade'); // article_tags テーブルの外部キー
        $table->timestamps(); // 作成日時、更新日時

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
