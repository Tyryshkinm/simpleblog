<?php

class login_controller extends controller
{
    function index()
    {
        $this->view->generate_view('template_view.php', 'login_view.php');
    }

    function login_user()
    {
        if (isset($_POST['login'])) {
            $data['username'] = $_POST['username'];
            echo $data['password'] = $_POST['password'];
            $this->model = new Model();
            $this->model->user_login($data);
        }
    }
}