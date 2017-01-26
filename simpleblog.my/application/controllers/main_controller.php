<?php

class main_controller extends controller
{
    function index()
    {
        $this->view->generate_view('template_view.php', 'main_view.php');
    }
}