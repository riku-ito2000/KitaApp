<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id'); // INT UNSIGNED の primary key
            $table->string('title', 255); // タイトル
            $table->mediumText('contents'); // 内容
            $table->unsignedInteger('member_id'); // 会員ID（INT UNSIGNED）
            $table->timestamps(); // 作成日時、更新日時
            $table->softDeletes(); // 削除日時

            // 外部キー制約を追加
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints(); // 外部キー制約を無効にする
        Schema::dropIfExists('articles'); // テーブルを削除
        Schema::enableForeignKeyConstraints(); // 外部キー制約を再度有効にする
    }
}

