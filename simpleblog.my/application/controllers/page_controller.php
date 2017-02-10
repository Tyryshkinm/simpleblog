<?php

class page_controller extends controller
{
    function index()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $current_page = $url[2];
        $data = $this->post_model->post_output($current_page, $last_page);
        $this->view->generate_view('template_view.php', 'main_view.php', $data, $current_page, $last_page);
    }
}