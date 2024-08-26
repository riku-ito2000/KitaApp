<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\Member;
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
        $articles = Article::all();

        foreach ($articles as $article) {
            // 各記事に対して10個のダミーコメントを作成
            for ($i = 1; $i <= 10; $i++) {
                ArticleComment::create([
                    'contents' => 'これはダミーコメント '.$i,
                    'member_id' => Member::inRandomOrder()->first()->id,
                    'article_id' => $article->id,
                ]);
            }
        }
    }
}
