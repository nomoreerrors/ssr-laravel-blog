<?php

namespace App\Repositories;

use App\Models\BlogPosts as Model;
use App\Models\User as User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;




class BlogPostsRepository extends BaseRepository 
{

    public static function getAllWithPaginate()
    {
        $columns = [
                    'id',
                    'title',
                    'slug',
                    'is_published',
                    'published_at',
                    'user_id',
                    'category_id'
                    ];

        $result = Model::select($columns)
                        ->orderBy('id', 'DESC')
                        ->join(['category', 'user'])
                        ->paginate(10);

                        // $posts = Model::where('user_id', 3)->get();
        // return $result;


        // $users = User::where('id', '>=', '7')->get();
        // $posts = Model::whereBelongsTo($users)->get();
        // dd($posts);
        dd($result);
    }
    //20/9 19/4 18/9
    


 
    public static function getItem(int $id): Model
    {

        return Model::find($id);
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