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
            session_regenerate_id();
            $user = $this->model->user_login($data);
            if ($user === false)
            {
                $error = "Ivalid username or password";
                $this->view->generate_view('template_view.php', 'login_view.php', $data = NULL, $current_page = NULL, $last_page = NULL, $error);
            }
            else
            {
                if ($data['password'] == $user['password'])
                {
                    $_SESSION['logged_user'] = $user['username'];
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['role'] = $user['role'];
                    header('Location:/');
                }
                else
                {
                    $error = "Ivalid username or password";
                    $this->view->generate_view('template_view.php', 'login_view.php', $data = NULL, $current_page = NULL, $last_page = NULL, $error);
                }
            }

        }
    }

    function logout_user()
    {
        $this->model->user_logout();
        header('Location:/');
    }
}