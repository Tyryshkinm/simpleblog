<?php

class main_controller extends controller
{
    function index()
    {
        $data = $this->model->post_output($current_page = 1, $last_page);
        $this->view->generate_view('template_view.php', 'main_view.php', $data, $current_page, $last_page);
    }
}