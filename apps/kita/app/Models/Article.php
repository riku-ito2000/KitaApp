<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'contents',
        'member_id',
    ];

    // メンバーとのリレーションシップを定義
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    // タグとのリレーションシップを定義
    public function tags()
    {
        return $this->belongsToMany(ArticleTag::class, 'article_article_tag', 'article_id', 'article_tag_id');
    }
}
