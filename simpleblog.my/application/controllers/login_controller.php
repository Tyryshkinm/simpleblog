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
            $data['password'] = $_POST['password'];
            $this->model = new Model();
            $this->model->user_login($data);
            header('Location:/');
        }
    }

    function logout_user()
    {
        unset($_SESSION['logged_user']->username);
        session_destroy();
        header('Location:/  ');
    }
}