<?php

class PageController extends Controller
{
    public function index()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $currentPage = $url[2];
        $data = $this->postModel->postOutput($currentPage, $lastPage);
        $this->view->generateView('TemplateView.php', 'PostMainView.php', $data, $currentPage, $lastPage);
    }
}