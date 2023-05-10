<?php
namespace App\Repositories;

use App\Models\BlogCategories as Model;
use Illuminate\Database\Eloquent\Collection;

abstract class BlogCategoryRepository extends BaseRepository 
{
    protected $model;


 
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    abstract protected function getModelClass();


 
}