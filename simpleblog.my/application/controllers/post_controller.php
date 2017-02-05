<?php

class post_controller extends controller
{
    function index()
    {
        $this->model = new Model();
        $this->model->post_page_output();
        $this->view->generate_view('template_view.php', 'post_view.php');
    }

    function edit()
    {
        $this->view->generate_view('template_view.php', 'post_edit_view.php');
    }

    function save_changes()
    {
        if (isset($_POST['save']))
        {
            $data['title'] = $_POST['post_title'];
            $data['text'] = $_POST['post_text'];
            $this->model = new Model();
            $this->model->post_edit($data);
        }
    }

    function delete()
    {
        $this->model = new Model();
        $this->model->post_delete();
    }
}