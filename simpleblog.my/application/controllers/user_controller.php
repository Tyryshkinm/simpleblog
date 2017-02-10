<?php

class user_controller extends controller
{
    function index()
    {
        $this->model->user_page_output();
        $data = $this->model->user_page_output();
        $this->view->generate_view('template_view.php', 'user_view.php', $data);
    }

    function edit()
    {
        $data = $this->model->user_page_output();
        $this->view->generate_view('template_view.php', 'user_edit_view.php', $data);
    }

    function save_changes()
    {
        $user = $this->model->user_page_output();
        if (isset($_POST['save']))
        {
            if (!empty($_POST['old_password'])) {
                if ($_POST['old_password'] == $user['password']) {
                    if ($_POST['password'] == $_POST['repeat_password']) {
                        $data['password'] = $_POST['password'];
                        $data['first_name'] = $_POST['first_name'];
                        $data['second_name'] = $_POST['second_name'];
                        $data['sex'] = $_POST['sex'];
                        $this->model->user_edit($data);
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
                $this->model->user_edit($data);
                header('Location:/user/'.$user['id'].'');
            }
        }
    }

    function delete()
    {
        $this->model->user_delete();
        header('Location:/');
    }

    function set_as_admin()
    {
        $this->model->set_as_admin();
    }
}