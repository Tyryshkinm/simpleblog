<?php

class controller
{
    public $view;
    public $model;
    function __construct()
    {
        $this->view = new View();
        $this->model = new Model();
    }
}