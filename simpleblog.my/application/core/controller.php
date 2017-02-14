<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/application/models/user_model.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/application/models/post_model.php');
class controller
{
    public $view;
    public $user_model;
    public $post_model;
    function __construct()
    {
        $this->view = new View();
        $this->user_model = new user_model();
        $this->post_model = new post_model();
    }
}