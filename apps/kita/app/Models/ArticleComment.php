<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property array<int, string> $fillable
 */
class ArticleComment extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'contents',
        'member_id',
        'article_id',
    ];

    // リレーションシップ定義
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
