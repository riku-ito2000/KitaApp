<?php

namespace Database\Seeders;

use App\Models\ArticleTag;
use Illuminate\Database\Seeder;

class ArticleTagSeeder extends Seeder
{
    public function run()
    {
        $tags = [
            'JavaScript',
            'PHP',
            'Vue',
            'Vite',
            'Laravel',
            'React',
            'Angular',
            'TypeScript',
            'Node.js',
            'Express',
            'Python',
            'Django',
            'Flask',
            'Ruby',
            'Rails',
            'HTML',
            'CSS',
            'Tailwind CSS',
            'Bootstrap',
            'SASS',
        ];

        foreach ($tags as $tag) {
            ArticleTag::create(['name' => $tag]);
        }
    }
}
