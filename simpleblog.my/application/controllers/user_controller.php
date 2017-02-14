<?php

class user_controller extends controller
{
    public $error;
    //index()
    function index()
    {
        $this->user_model->user_page_output();
        $data = $this->user_model->user_page_output();
        $this->view->generate_view('template_view.php', 'user_view.php', $data);
    }

    //registration()
    function registration()
    {
        if (isset($_POST['register']))
        {
            $data['username'] = $_POST['username'];
            $data['password'] = $_POST['password'];
            $data['first_name'] = $_POST['first_name'];
            $data['second_name'] = $_POST['second_name'];
            $data['sex'] = $_POST['sex'];
            if ($data['password'] == $_POST['repeat_password'])
            {
                $user = $this->user_model->user_check($data);
                if ($data['username'] == $user['username'])
                {
                    $this->error = "A person with this username already exists";
                }
                else
                {
                    $this->user_model->user_registration($data);
                    $this->view->generate_view('template_view.php', 'login_view.php');
                }
            }
            else
            {
                $this->error = "Passwords do not match";
            }
        }
        $this->view->generate_view('template_view.php', 'registration_view.php', $data = NULL, $current_page = NULL, $last_page = NULL, $this->error);
    }

    //login()
    function login()
    {
        if (isset($_POST['login'])) {
            $data['username'] = $_POST['username'];
            $data['password'] = $_POST['password'];
            session_regenerate_id();
            $user = $this->user_model->user_login($data);
            if ($user === false) {
                $this->error = "Invalid username or password";
            } else {
                if ($data['password'] == $user['password']) {
                    $_SESSION['logged_user'] = $user['username'];
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['role'] = $user['role'];
                    header('Location:/');
                } else {
                    $this->error = "Invalid username or password";
                }
            }
        }
        $this->view->generate_view('template_view.php', 'login_view.php', $data = NULL, $current_page = NULL, $last_page = NULL, $this->error);
    }

    //logout()
    function logout()
    {
        $this->user_model->user_logout();
        header('Location:/');
    }
    //edit()
    function edit()
    {
        if (isset($_SESSION['user_id']))
        {
            $data = $this->user_model->user_page_output();
            $user_id['id'] = $data['id'];
            if ($_SESSION['user_id'] == $user_id['id'])
            {
                $data = $this->user_model->user_page_output();
                $this->view->generate_view('template_view.php', 'user_edit_view.php', $data);
            }
            elseif ($_SESSION['role'] == 1)
            {
                $data = $this->user_model->user_page_output();
                $this->view->generate_view('template_view.php', 'user_edit_view.php', $data);
            }
            else
            {
                $error = "You have not permissions";
                $this->view->generate_view('template_view.php', '404_view.php', $data = NULL, $current_page = NULL, $last_page = NULL, $error);
            }
        }
        else
        {
            $error = "You have not permissions";
            $this->view->generate_view('template_view.php', '404_view.php', $data = NULL, $current_page = NULL, $last_page = NULL, $error);
        }
        //update changes
        $user = $this->user_model->user_page_output();
        if (isset($_POST['save']))
        {
            if (!empty($_POST['old_password'])) {
                if ($_POST['old_password'] == $user['password']) {
                    if ($_POST['password'] == $_POST['repeat_password']) {
                        $data['password'] = $_POST['password'];
                        $data['first_name'] = $_POST['first_name'];
                        $data['second_name'] = $_POST['second_name'];
                        $data['sex'] = $_POST['sex'];
                        $this->user_model->user_edit($data);
                        header('Location:/user/'.$user['id'].'');
                    }
                    else
                    {
                        $error = "passwords do not match";
                        $this->view->generate_view('template_view.php', 'registration_view.php', $data = NULL, $current_page = NULL, $last_page = NULL, $error);
                    }
                }
                else
                {
                    $error = "The new password must differ from the old";
                    $this->view->generate_view('template_view.php', 'registration_view.php', $data = NULL, $current_page = NULL, $last_page = NULL, $error);
                }
            }
            else
            {
                $data['password'] = $user['password'];
                $data['first_name'] = $_POST['first_name'];
                $data['second_name'] = $_POST['second_name'];
                $data['sex'] = $_POST['sex'];
                $this->user_model->user_edit($data);
                header('Location:/user/'.$user['id'].'');
            }
        }
    }

    //delete()
    function delete()
    {
        if ($_SESSION['role'] == 1)
        {
            $this->user_model->user_delete();
            header('Location:/');

        }

    }

    //setAsAdmin()
    function set_as_admin()
    {
        if ($_SESSION['role'] == 1)
        {
            $this->user_model->set_as_admin();
        }
    }
}