<?php

class registration_controller extends controller
{
    function index()
    {
        $this->view->generate_view('template_view.php', 'registration_view.php');
    }

}