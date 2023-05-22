<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

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
}
