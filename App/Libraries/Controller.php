<?php
class Controller{
    public function model($model){
     require_once '../app/Models/'.$model.'.php';
     return new $model;
    }//fim da function model
    
    public function view($view, $data = []) {
        if (file_exists(__DIR__ . "/../Views/{$view}.php")) {
            include __DIR__ . "/../Views/{$view}.php";
        } else {
            include __DIR__ . "/../Views/404.php";
        }
    }//fim da function view
}//fim da classe
