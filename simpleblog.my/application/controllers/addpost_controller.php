<?php

class addpost_controller extends controller
{
    function index()
    {
        $this->view->generate_view('template_view.php', 'addpost_view.php');
    }

    function add()
    {
        if (isset($_POST['add'])) {
            $data['title'] = $_POST['post_title'];
            $data['text'] = $_POST['post_text'];
            $this->model = new Model();
            $this->model->post_add($data);
        }

    }

    function editpost()
    {

    }
}