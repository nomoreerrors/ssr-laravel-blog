<?php

namespace App\Repositories;

use App\Models\BlogPosts as Model;
use App\Models\User as User;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;




class BlogPostsRepository extends BaseRepository 
{


    public static function getItem(int $id): Model
    {

        return Model::find($id);
    }


    public static function deleteItem(string $id): void
    {
            Model::where('id', $id);
            //    Model::where('id', $id)->delete();
    }




    public static function getAllWithPaginate(int $page_count)
    {
        $columns = [
                'blog_categories.title AS category_name',
                'blog_posts.id',
                'blog_posts.title',
                'blog_posts.slug',
                'blog_posts.is_published',
                'blog_posts.published_at',
                'blog_posts.category_id AS category_number',
                'users.name AS author'
                ];

                

    $result = Model::join('blog_categories', 'blog_categories.id', '=', 'blog_posts.category_id')
                ->join('users', 'users.id', '=', 'blog_posts.user_id')
                ->select($columns)
                ->orderBy('id', 'DESC')
                ->paginate($page_count);

        return $result;
         
    }
     
 
 
}

