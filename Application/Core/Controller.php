<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Application/Models/UserModel.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Application/Models/PostModel.php');
class Controller
{
    public $view;
    public $userModel;
    public $postModel;
    public function __construct()
    {
        $this->view = new View();
        $this->userModel = new UserModel();
        $this->postModel = new PostModel();
    }
}