<?php
class Controller {
    protected $model;
    public function model($modelName) {
        if(file_exists(MODEL . $modelName . '.php')) {
            $this->model = new $modelName;
        }
        return $this->model;
    }
}