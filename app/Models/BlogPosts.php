<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;



/**
 * @property string $excerpt
 * 
 */



class BlogPosts extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'blog_posts';

    const UNKNOWN_USER = 1;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'content_html',
        'updated_at',
        'content_raw',
        'excerpt',
        'is_published',
        'published_at'
    ];


    public function getDateFormat()
    {
        return Carbon::now()->add(3, 'hours');
    }
   
    
    
    //foreign key blog_posts.category_id references blog_categories.id  
    //или посты принадлежат категориям
    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategories::class);
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
