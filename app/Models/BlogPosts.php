<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPosts extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'blog_posts';



    //relationships - связь двух таблиц
    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategories::class);
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
