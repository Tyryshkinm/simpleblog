<?php

class addpost_controller extends controller
{
    function index()
    {
        $this->view->generate_view('template_view.php', 'addpost_view.php');
    }

    function add()
    {
        if (isset($_SESSION['logged_user']))
        {
            if (isset($_POST['add'])) {
                $data['title'] = $_POST['post_title'];
                $data['text'] = $_POST['post_text'];
                $this->model->post_add($data);
                header('Location:/');
            }
        }
        else header('Location:/login');
    }
}