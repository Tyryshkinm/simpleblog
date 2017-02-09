<?php

class main_controller extends controller
{
    function index()
    {
        if (isset($_POST['page']))
        {
            $current_page = $_POST['page'];
            $this->model = new Model();
            $this->model->paged_posts($current_page);
            $data = $this->model->post_output();
            $last_page = $this->model->last_page();
            $this->view->generate_view('template_view.php', 'main_view.php', $data, $current_page, $last_page);
        }else
        {
            $this->model = new Model();
            $this->model->paged_posts($current_page = 1);
            $data = $this->model->post_output();
            $last_page = $this->model->last_page();
            $this->view->generate_view('template_view.php', 'main_view.php', $data, $current_page, $last_page);
        }
    }
}