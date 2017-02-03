<?php

class post_controller extends controller
{
    function index()
    {
        $this->model = new Model();
        $this->model->post_page_output();
        $this->view->generate_view('template_view.php', 'post_view.php');
    }
}