<?php

class PostController extends Controller
{
    public function index()
    {
        if (isset($_GET['page'])) {
            $currentPage = $_GET['page'];
            $data = $this->postModel->postOutput($currentPage, $lastPage);
            $this->view->generateView('TemplateView.php', 'PostMainView.php', $data);
            $this->view->generatePagination('PaginationView.php', $currentPage, $lastPage);
        } else {
            $data = $this->postModel->postOutput($currentPage = 1, $lastPage);
            $this->view->generateView('TemplateView.php', 'PostMainView.php', $data);
            $this->view->generatePagination('PaginationView.php', $currentPage, $lastPage);
        }
    }

    public function view()
    {
        $data = $this->postModel->postPageOutput();
        if (is_array($data)) {
            $this->view->generateView('TemplateView.php', 'PostView.php', $data);
        } else {
            $this->view->generateView('TemplateView.php', '404View.php');
        }
    }

    public function add()
    {
        $this->view->generateView('TemplateView.php', 'PostAddView.php');
        if (isset($_SESSION['loggedUser'])) {
            if (isset($_POST['add'])) {
                $data['title'] = $_POST['postTitle'];
                $data['text'] = $_POST['postText'];
                $this->postModel->postAdd($data);
                Route::redirekt($controller = NULL, $action = NULL, $parametr = NULL);
            }
        }
    }

    public function edit()
    {
        if (isset($_SESSION['userId'])) {
            $authorId = $this->postModel->verificationAuthorOfPost($numpost);
            if ($_SESSION['userId'] == $authorId['author']) {
                $data = $this->postModel->postPageOutput();
                $this->view->generateView('TemplateView.php', 'PostEditView.php', $data);
            } elseif ($_SESSION['role'] == 1) {
                $data = $this->postModel->postPageOutput();
                $this->view->generateView('TemplateView.php', 'PostEditView.php', $data);
            } else {
                $error = 'You have not permissions';
                $this->view->generateView('TemplateView.php', '404View.php', $data = NULL, $error);
            }
        } else {
            $error = 'You have not permissions';
            $this->view->generateView('TemplateView.php', '404View.php', $data = NULL, $error);
        }
        if (isset($_POST['save'])) {
            $data['title'] = $_POST['postTitle'];
            $data['text'] = $_POST['postText'];
            $parametr = $this->postModel->postEdit($data);
            Route::redirekt($controller = 'post', $action = 'view', $parametr);
        }
    }

    public function delete()
    {
        if (isset($_SESSION['userId'])) {
            $authorId = $this->postModel->verificationAuthorOfPost($numpost);
            if ($_SESSION['userId'] == $authorId['author']) {
                $this->postModel->postDelete($numpost);
                header('Location:/');
            } elseif ($_SESSION['role'] == 1) {
                $this->postModel->postDelete($numpost);
                Route::redirekt($controller = NULL, $action = NULL, $parametr = NULL);
            } else {
                $error = 'You have not permissions';
                $this->view->generateView('TemplateView.php', 'PostView.php', $data = NULL, $error);
            }
        }
    }

    public function pageNotFound()
    {
        $this->view->generateView('TemplateView.php', '404View.php');
    }
}