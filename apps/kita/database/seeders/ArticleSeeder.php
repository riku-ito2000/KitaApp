<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Member;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        // タグを全て取得
        $tags = ArticleTag::all();

        // 100件のデータを追加
        for ($i = 1; $i <= 100; $i++) {
            $article = Article::create([
                'title' => $faker->sentence,
                'contents' => $faker->paragraph,
                'member_id' => $faker->numberBetween(1, 100), // 1から100までのランダムな member_id を指定
            ]);

            // タグが存在する場合にのみランダムにタグを付与
            if ($tags->isNotEmpty()) {
                $randomTags = $tags->random(rand(1, 3))->pluck('id')->toArray();
                $article->tags()->attach($randomTags);
            }
        }
    }
}
