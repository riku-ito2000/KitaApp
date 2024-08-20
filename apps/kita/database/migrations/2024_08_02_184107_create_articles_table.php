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
            $table->id(); // ID
            $table->string('title', 255); // タイトル
            $table->mediumText('contents'); // 内容
            $table->unsignedInteger('member_id'); // 会員ID
            $table->timestamps(); // 作成日時、更新日時
            $table->softDeletes(); // 削除日時

            // 外部キー制約
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
        Schema::dropIfExists('articles');
    }
}

