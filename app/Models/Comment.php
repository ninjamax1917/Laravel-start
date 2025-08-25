<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 
    'article_id', 
    'text'
];

public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}

public function article(): BelongsTo
{
    return $this->belongsTo(Article::class);
}
}
