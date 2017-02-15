<?php

class PostController extends Controller
{
    //index()
    public function index()
    {
        $data = $this->postModel->postOutput($currentPage = 1, $lastPage);
        $this->view->generateView('TemplateView.php', 'PostMainView.php', $data, $currentPage, $lastPage);
    }

    public function view()
    {
        $data = $this->postModel->postPageOutput();
        $this->view->generateView('TemplateView.php', 'PostView.php', $data);
    }

    public function add()
    {
        $this->view->generateView('TemplateView.php', 'PostAddView.php');
        if (isset($_SESSION['loggedUser'])) {
            if (isset($_POST['add'])) {
                $data['title'] = $_POST['postTitle'];
                $data['text'] = $_POST['postText'];
                $this->postModel->postAdd($data);
                header('Location:/');
            }
        } else {
            header('Location:/login');
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
                $this->view->generateView('TemplateView.php', '404View.php',
                    $data = NULL, $current_page = NULL, $last_page = NULL, $error);
            }
        } else {
            $error = 'You have not permissions';
            $this->view->generateView('TemplateView.php', '404View.php',
                $data = NULL, $current_page = NULL, $last_page = NULL, $error);
        }
        if (isset($_POST['save'])) {
            $data['title'] = $_POST['postTitle'];
            $data['text'] = $_POST['postText'];
            $this->postModel->postEdit($data);
            header('Location: /post/' . $numpost . '/view');
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
                header('Location:/');
            } else {
                $error = 'You have not permissions';
                $this->view->generateView('TemplateView.php', 'PostView.php',
                    $data = NULL, $current_page = NULL, $last_page = NULL, $error);
            }
        }
    }

    public function pageNotFound()
    {
        $this->view->generateView('TemplateView.php', '404View.php');
    }

}