<?php

class registration_controller extends controller
{
    function index()
    {
        $this->view->generate_view('template_view.php', 'registration_view.php');
    }

    function add_user()
    {
        if (isset($_POST['register'])) {
            $data['username'] = $_POST['username'];
            $data['password'] = $_POST['password'];
            $data['first_name'] = $_POST['first_name'];
            $data['second_name'] = $_POST['second_name'];
            $data['sex'] = $_POST['sex'];
            if ($data['password'] == $_POST['repeat_password'])
            {
                $user = $this->model->user_check($data);
                if ($data['username'] == $user['username'])
                {
                    $error = "A person with this username already exists";
                    $this->view->generate_view('template_view.php', 'registration_view.php', $data = NULL, $current_page = NULL, $last_page = NULL, $error);
                }
                else
                {
                    $this->model->user_registration($data);
                    $this->view->generate_view('template_view.php', 'login_view.php');
                }
            }
            else
            {
                $error = "Passwords do not match";
                $this->view->generate_view('template_view.php', 'registration_view.php', $data = NULL, $current_page = NULL, $last_page = NULL, $error);
            }
        }
    }
}