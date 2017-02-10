<?php

class post_controller extends controller
{
    function index()
    {
        $data = $this->model->post_page_output();
        $this->view->generate_view('template_view.php', 'post_view.php', $data);
    }
    function edit()
    {
        $data = $this->model->post_page_output();
        $this->view->generate_view('template_view.php', 'post_edit_view.php', $data);
    }
    function save_changes()
    {
        if (isset($_POST['save']))
        {
            $data['title'] = $_POST['post_title'];
            $data['text'] = $_POST['post_text'];
            $this->model->post_edit($data);
        }
    }
    function delete()
    {
        $this->model->post_delete();
        header('Location:/');
    }
}