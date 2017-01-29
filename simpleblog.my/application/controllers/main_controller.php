<?php

class main_controller extends controller
{
    function index()
    {
        session_start();
        $this->view->generate_view('template_view.php', 'main_view.php');
    }
}