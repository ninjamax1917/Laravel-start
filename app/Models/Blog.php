<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{

     use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'text'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function polyComments(): MorphMany
    {
        return $this->morphMany(PolyComment::class, 'commentable');
    }
}
