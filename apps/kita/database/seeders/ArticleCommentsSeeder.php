<?php

namespace Database\Seeders;

use App\Models\ArticleComment;
use Illuminate\Database\Seeder; // モデルをインポート

class ArticleCommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 例: ダミーコメントを10個作成する
        for ($i = 1; $i <= 10; $i++) {
            ArticleComment::create([
                'contents' => 'これはダミーコメント '.$i,
                'member_id' => \App\Models\Member::inRandomOrder()->first()->id,
                'article_id' => \App\Models\Article::inRandomOrder()->first()->id,
            ]);
        }
    }
}
