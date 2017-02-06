<?php

class user_controller extends controller
{
    function index()
    {
        $this->model = new Model();
        $this->model->user_page_output();
        $this->view->generate_view('template_view.php', 'user_view.php');
    }

    function edit()
    {
        $this->view->generate_view('template_view.php', 'user_edit_view.php');
    }

    function save_changes()
    {
        $this->model = new Model();
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
                        $this->model = new Model();
                        $this->model->user_edit($data);
                        header('Location:/user/'.$user['id'].'');
                    } else echo "пароль не совпадают";
                } else echo "Новый пароль должен отличаться от старого";
            }
            else
            {
                $data['password'] = $user['password'];
                $data['first_name'] = $_POST['first_name'];
                $data['second_name'] = $_POST['second_name'];
                $data['sex'] = $_POST['sex'];
                $this->model = new Model();
                $this->model->user_edit($data);
                header('Location:/user/'.$user['id'].'');
            }
        }
    }

    function delete()
    {
        $this->model = new Model();
        $this->model->user_delete();
        //$this->model->user_logout();
    }

    function set_as_admin()
    {
        $this->model = new Model();
        $this->model->set_as_admin();
    }
}