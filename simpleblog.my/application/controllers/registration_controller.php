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
                $this->model = new Model();
                $this->model->user_registration($data);
            }
            else echo "Passwords do not match";
        }
    }
}