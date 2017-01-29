<?php

class addpost_controller extends controller
{
    function index()
    {
        session_start();
        $this->view->generate_view('template_view.php', 'addpost_view.php');
    }

    function addpost()
    {

    }

    function editpost()
    {

    }
}