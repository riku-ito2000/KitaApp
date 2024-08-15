<?php

namespace Database\Seeders;

use App\Models\ArticleTag;
use Illuminate\Database\Seeder;

class ArticleTagSeeder extends Seeder
{
    public function run()
    {
        ArticleTag::create(['name' => 'JavaScript']);
        ArticleTag::create(['name' => 'PHP']);
        ArticleTag::create(['name' => 'Vue']);
        ArticleTag::create(['name' => 'Vite']);
    }
}
