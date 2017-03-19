<?php

class PostController extends Controller
{
    public function index()
    {
        if (isset($_GET['page']) and !isset($_GET['amt'])) {
            $currentPage = $_GET['page'];
            $data = $this->postModel->postOutput($currentPage, $lastPage, $amt = 10);
            $likedPosts = $this->postModel->likedPosts($data);
            if (isset($_SESSION['loggedUser']))
            {
                $this->postModel->likedPostsByUser($_SESSION['userId'], $data);
            }
            $this->view->generateView('TemplateView.php', 'PostMainView.php', $data, $this->view->msgError, $likedPosts);
            $this->view->generatePagination('PaginationView.php', $currentPage, $lastPage, $url = NULL, $amt);
        }

        if (isset($_GET['page']) and  isset($_GET['amt'])) {
            $currentPage = $_GET['page'];
            $data = $this->postModel->postOutput($currentPage, $lastPage, $amt = $_GET['amt']);
            $likedPosts = $this->postModel->likedPosts($data);
            if (isset($_SESSION['loggedUser']))
            {
                $this->postModel->likedPostsByUser($_SESSION['userId'], $data);
            }
            $this->view->generateView('TemplateView.php', 'PostMainView.php', $data, $this->view->msgError, $likedPosts);
            $this->view->generatePagination('PaginationView.php', $currentPage, $lastPage, $url = NULL, $amt);
        }

        if (!isset($_GET['page']) and isset($_GET['amt'])) {
            $data = $this->postModel->postOutput($currentPage = 1, $lastPage, $amt = $_GET['amt']);
            $likedPosts = $this->postModel->likedPosts($data);
            if (isset($_SESSION['loggedUser']))
            {
                $this->postModel->likedPostsByUser($_SESSION['userId'], $data);
            }
            $this->view->generateView('TemplateView.php', 'PostMainView.php', $data, $this->view->msgError, $likedPosts);
            $this->view->generatePagination('PaginationView.php', $currentPage, $lastPage, $url = NULL, $amt);
        }

        if (!isset($_GET['page']) and  !isset($_GET['amt'])) {
            $data = $this->postModel->postOutput($currentPage = 1, $lastPage, $amt = 10);
            $likedPosts = $this->postModel->likedPosts($data);
            if (isset($_SESSION['loggedUser']))
            {
                $this->postModel->likedPostsByUser($_SESSION['userId'], $data);
            }
            $this->view->generateView('TemplateView.php', 'PostMainView.php', $data, $this->view->msgError, $likedPosts);
            $this->view->generatePagination('PaginationView.php', $currentPage, $lastPage, $url = NULL, $amt);
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

    public function clickOnPencil()
    {
        $postId = $_POST['postId'];
        $dataPost = $this->postModel->clickOnPencil($postId);
        $dataText = $dataPost['text'];
        $dataTitle = $dataPost['title'];
        echo   '<div class="postEdit">
                    <input type="text" id="editTitle' . $postId . '" maxlength="50" name="postTitle" value="' . $dataTitle . '" placeholder="Title of Post" required /></br>
                    <textarea id="editText' . $postId . '" name="postText" cols="25" rows="10" placeholder="Text of Post" required >' . $dataText . '</textarea></br>
                    <button class="btn btn-primary">Save</button>
                </div>';
    }

    public function clickOnSave()
    {
        $postId = $_POST['postId'];
        $title = $_POST['title'];
        $text = $_POST['text'];
        $this->postModel->clickOnSave($postId, $title, $text);
    }

    public function clickOnHeart()
    {
        if (isset($_SESSION['userId'])) {
            $postId = $_POST['postId'];
            $userId = $_SESSION['userId'];
            $data = $this -> postModel -> clickOnHeart($postId, $userId, $limit);
            for ($i = 0; $i < $limit; $i++)
            {
                if (isset($data[$i]['username'])) {
                    $whoLikes[$i] = '<a href="/user/' . $data[$i]['user_id'] . '">' . $data[$i]['username'] . '</a>' . ',';
                    $data[$i]['username'] = $whoLikes[$i];
                }
            }
            if (empty($data) or !isset($data)) {
                echo 1;
            } else {
                foreach ($data as $row)
                {
                    echo $row['username'];
                }
            }
        } else {
            echo 2;
        }
    }

    public function overHeart()
    {
        $postId = $_POST['postId'];
        $limit = 6;
        if (isset($_POST['viewmore'])) {
            $count = $_POST['viewmore'];
            $limit = $limit + $count * 10;
        }
        $data = $this->postModel->overHeart($postId, $limit);
        for ($i = 0; $i < $limit; $i++)
        {
            if (isset($data[$i]['username'])) {
                $whoLikes[$i] = '<a href="/user/' . $data[$i]['user_id'] . '">' . $data[$i]['username'] . '</a>' . ',';
                $data[$i]['username'] = $whoLikes[$i];
            }
        }
        if (empty($data)) {
            echo 1;
        } else {
            foreach ($data as $row)
            {
                echo $row['username'];
            }
        }
    }
}