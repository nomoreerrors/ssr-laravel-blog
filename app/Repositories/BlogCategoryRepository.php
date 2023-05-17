<?php

namespace App\Repositories;

use App\Models\BlogCategories as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;




class BlogCategoryRepository extends BaseRepository 
{

    public static function getAllWithPaginate($perPage = null)
    {
        $columns = ['id', 'title', 'parent_id'];
        $result = Model::select($columns)
                        ->paginate($perPage);
        return $result;
    }



 
 




    //получить список категорий для вывода в выпадающем меню
    public static function getForComboBox()
    {
         $result = Model::selectRaw('id, CONCAT(id, ". ", title) AS id_title')
                         ->toBase()
                         ->get();
        return $result;
    }

 
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