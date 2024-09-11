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
        // メンバーを全て取得
        $members = Member::all();

        // 100件のデータを追加
        for ($i = 1; $i <= 100; $i++) {
            // メンバーが存在する場合にランダムにメンバーを選択
            if ($members->isNotEmpty()) {
                $randomMember = $members->random()->id;

                $article = Article::create([
                    'title' => $faker->sentence,
                    'contents' => $faker->paragraph,
                    'member_id' => $randomMember, // ランダムな member_id を指定
                ]);

                // タグが存在する場合にのみランダムにタグを付与
                if ($tags->isNotEmpty()) {
                    $randomTags = $tags->random(rand(1, 20))->pluck('id')->toArray();
                    $article->tags()->attach($randomTags);
                }
            }
        }
    }
}
