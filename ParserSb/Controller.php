<?php

class Controller
{
    //Класс Контроллера.
    private $model;
    private $view;
    public function __construct($model,$view){
        $this->model = $model;
        $this->view = $view;
    }
    public function getData($date) {
        $data = $this->model->getData($date);
        $this->view->output($data);

    }
}