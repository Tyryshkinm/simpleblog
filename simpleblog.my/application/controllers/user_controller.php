<?php

class user_controller extends controller
{
    function index()
    {
        $this->model = new Model();
        $this->model->user_page_output();
        $this->view->generate_view('template_view.php', 'user_view.php');
    }
}