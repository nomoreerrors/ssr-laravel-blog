<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;



abstract class BaseRepository 
{   

    protected $model;

    //получаем экземпляр класса модели потомка в свойство model
    public function __construct()
    {
        $this->model = app($this->getModelClass());
        
    }

    abstract protected function getModelClass();



    //Получаем клон объекта, чтобы состояние model не хранилось в классе
    protected function startConditions()
    {
        return clone $this->model;
    }
}