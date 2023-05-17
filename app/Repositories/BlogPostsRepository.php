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
               Model::where('id', $id)->delete();
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
     
 
  




    //получить список категорий для вывода в выпадающем меню
    // public static function getForComboBox()
    // {
    //      $result = Model::selectRaw('id, CONCAT(id, ". ", title) AS id_title')
    //                      ->toBase()
    //                      ->get();
    //     return $result;
    // }

 
}

// class BlogCategoryRepository extends BaseRepository 
// {
    
//     //получить модель для редактирования в админке в свойство model(абстрактное)
//     protected function getModelClass() 
//     {
//         return Model::class;
//     }


//     public function getAllWithPaginate($perPage = null)
//     {
//         $columns = ['id', 'title', 'parent_id'];
//         $result = $this->startConditions()
//                         ->select($columns)
//                         ->paginate($perPage);

//         return $result;
//     }


 
//     public function getEdit(int $id): Model
//     {
//         return $this->startConditions()->find($id);
//     }


//     //получить список категорий для вывода в выпадающем меню
//     public static function getForComboBox()
//     {

//          $result = $this->startConditions()
//                          ->selectRaw('id, CONCAT(id, ". ", title) AS id_title')
//                          ->toBase()
//                          ->get();


//         // dd($result[0]);
//         return $result;
//     }

    


 
// }