<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

class BlogCategories extends Model
{
    use HasFactory;
    use SoftDeletes;




    protected $table = 'blog_categories';



    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'description',
    ];



    public function getDateFormat()
    {
        return Carbon::now()->add(3, 'hours');
    }


    /**
     * 
     * Foreign key blog_categories.parent_id references blog_categories_id  
     */

    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(BlogCategories::class, 'parent_id', 'id')
                            ->withDefault(['title' => 'Категория неизвестна']);
    }


    public function getParentTitleAttribute()
    {
        return $this->parentCategory->title;
    }


    /**
     * Converting title attribute to uppercase
     */
    // protected function title(): Attribute
    // {
    // return Attribute::make(
    //     get: fn (string $value) => Str::upper($value),
    // );
    
    // }

}
