<?php
namespace App\Repositories;



abstract class BaseRepository 
{
    protected $model;


    public function __construct()
    {
        $this->model = app($this->getModelClass());
        //метод, реализуемый потомком
    }


    abstract protected function getModelClass();


    protected function startConditions()
    {
        return clone $this->model;
    }
}