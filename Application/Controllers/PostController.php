<?php

class PostController extends Controller
{
    public function index()
    {
        if (isset($_GET['page'])) {
            $currentPage = $_GET['page'];
            $data = $this->postModel->postOutput($currentPage, $lastPage);
            $this->view->generateView('TemplateView.php', 'PostMainView.php', $data, $this->view->msgError);
            $this->view->generatePagination('PaginationView.php', $currentPage, $lastPage);
        } else {
            $data = $this->postModel->postOutput($currentPage = 1, $lastPage);
            $this->view->generateView('TemplateView.php', 'PostMainView.php', $data, $this->view->msgError);
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
        if (isset($_SESSION['loggedUser'])) {
            $this->view->contentView = 'PostAddView.php';
            if (isset($_POST['add'])) {
                $data['title'] = trim($_POST['postTitle']);
                $data['text'] = trim($_POST['postText']);
                if (!empty($data['title'])) {
                    if (!empty($data['text'])) {
                        $this->postModel->postAdd($data);
                        Route::redirekt($controller = NULL, $action = NULL, $parametr = NULL);
                    } else {
                        $this->view->contentView = 'PostAddView.php';
                        $this->view->msgError = 'Textarea is empty!';
                    }
                } else {
                    $this->view->contentView = 'PostAddView.php';
                    $this->view->msgError = 'Title is empty!';
                }
            }
        } else {
            $this->view->contentView = '404View.php';
        }
        $this->view->generateView('TemplateView.php', $this->view->contentView, $data = NULL, $this->view->msgError);
    }

    public function edit()
    {
        if (isset($_SESSION['userId'])) {
            $authorId = $this->postModel->verificationAuthorOfPost($numpost);
            if ($_SESSION['userId'] == $authorId['author'] or $_SESSION['role'] == 1) {
                $this->view->data = $this->postModel->postPageOutput();
                $this->view->contentView = 'PostEditView.php';
                if (isset($_POST['save'])) {
                    $data['title'] = trim($_POST['postTitle']);
                    $data['text'] = trim($_POST['postText']);
                    if (!empty($data['title'])) {
                        if (!empty($data['text'])) {
                            $parametr = $this->postModel->postEdit($data);
                            Route::redirekt($controller = 'post', $action = 'view', $parametr);
                        } else {
                            $this->view->contentView = 'PostEditView.php';
                            $this->view->msgError = 'Textarea is empty!';
                        }
                    } else {
                        $this->view->contentView = 'PostEditView.php';
                        $this->view->msgError = 'Title is empty!';
                    }
                }
            } else {
                $this->view->contentView = '404View.php';
            }
        } else {
            $this->view->contentView = '404View.php';
        }
        $this->view->generateView('TemplateView.php', $this->view->contentView, $this->view->data, $this->view->msgError);
    }

    public function delete()
    {
        if (isset($_SESSION['userId'])) {
            $authorId = $this->postModel->verificationAuthorOfPost($numpost);
            if ($_SESSION['userId'] == $authorId['author'] or $_SESSION['role'] == 1) {
                $this->postModel->postDelete($numpost);
                Route::redirekt($controller = NULL, $action = NULL, $parametr = NULL);
            } else {
                $this->view->contentView = '404View.php';
            }
        } else {
            $this->view->contentView = '404View.php';
        }
        $this->view->generateView('TemplateView.php', $this->view->contentView);
    }

    public function search()
    {
        if (isset($_POST['search'])) {
            if (!empty($_POST['search'])) {
                $search = $_POST['search'];
                $data = $this->postModel->search($search);
                if (!empty($data)) {
                    $this->view->generateView('TemplateView.php', 'SearchView.php', $data);
                } else {
                    $this->view->msgError = 'Nothing found';
                    $this->view->generateView('TemplateView.php', 'SearchView.php', $data, $this->view->msgError);
                }
            } else {
                $this->view->msgError = 'Nothing found';
                $this->view->generateView('TemplateView.php', 'SearchView.php', $data = NULL, $this->view->msgError);
            }
        } else {
            $this->view->generateView('TemplateView.php', 'SearchView.php');
        }
    }
}