<?php

class UserController extends Controller
{
    public $error;
    public function index()
    {
        $this->userModel->userPageOutput();
        $data = $this->userModel->userPageOutput();
        $this->view->generateView('TemplateView.php', 'UserView.php', $data);
    }

    public function registration()
    {
        if (isset($_POST['register'])) {
            $data['username'] = $_POST['username'];
            $data['password'] = $_POST['password'];
            $data['firstName'] = $_POST['firstName'];
            $data['secondName'] = $_POST['secondName'];
            $data['sex'] = $_POST['sex'];
            if ($data['password'] == $_POST['repeatPassword']) {
                $user = $this->userModel->userCheck($data);
                if ($data['username'] == $user['username']) {
                    $this->error = 'A person with this username already exists';
                } else {
                    $this->userModel->userRegistration($data);
                    header('Location:/user/login');
                }
            } else {
                $this->error = 'Passwords do not match';
            }
        }
        $this->view->generateView('TemplateView.php', 'UserRegistrationView.php',
            $data = NULL, $current_page = NULL, $last_page = NULL, $this->error);
    }

    public function login()
    {
        if (isset($_POST['login'])) {
            $data['username'] = $_POST['username'];
            $data['password'] = $_POST['password'];
            session_regenerate_id();
            $user = $this->userModel->userLogin($data);
            if ($user === false) {
                $this->error = 'Invalid username or password';
            } else {
                if ($data['password'] == $user['password']) {
                    $_SESSION['loggedUser'] = $user['username'];
                    $_SESSION['userId'] = $user['id'];
                    $_SESSION['role'] = $user['role'];
                    header('Location:/');
                } else {
                    $this->error = 'Invalid username or password';
                }
            }
        }
        $this->view->generateView('TemplateView.php', 'UserLoginView.php',
            $data = NULL, $current_page = NULL, $last_page = NULL, $this->error);
    }

    public function logout()
    {
        $this->userModel->userLogout();
        header('Location:/');
    }

    public function edit()
    {
        if (isset($_SESSION['userId'])) {
            $data = $this->userModel->userPageOutput();
            $userId['id'] = $data['id'];
            if ($_SESSION['userId'] == $userId['id']) {
                $data = $this->userModel->userPageOutput();
                $this->view->generateView('TemplateView.php', 'UserEditView.php', $data);
            } elseif ($_SESSION['role'] == 1) {
                $data = $this->userModel->userPageOutput();
                $this->view->generateView('TemplateView.php', 'UserEditView.php', $data);
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
        //update changes
        $user = $this->userModel->userPageOutput();
        if (isset($_POST['save'])) {
            if (!empty($_POST['oldPassword'])) {
                if ($_POST['oldPassword'] == $user['password']) {
                    if ($_POST['password'] == $_POST['repeatPassword']) {
                        $data['password'] = $_POST['password'];
                        $data['firstName'] = $_POST['firstName'];
                        $data['secondName'] = $_POST['secondName'];
                        $data['sex'] = $_POST['sex'];
                        $this->userModel->userEdit($data);
                        header('Location:/user/' . $user['id'] . '');
                    } else {
                        $error = 'passwords do not match';
                        $this->view->generateView('TemplateView.php', 'UserRegistrationView.php',
                            $data = NULL, $current_page = NULL, $last_page = NULL, $error);
                    }
                } else {
                    $error = 'The new password must differ from the old';
                    $this->view->generateView('TemplateView.php', 'UserRegistrationView.php',
                        $data = NULL, $current_page = NULL, $last_page = NULL, $error);
                }
            } else {
                $data['password'] = $user['password'];
                $data['firstName'] = $_POST['firstName'];
                $data['secondName'] = $_POST['secondName'];
                $data['sex'] = $_POST['sex'];
                $this->userModel->userEdit($data);
                header('Location:/user/' . $user['id'] . '');
            }
        }
    }

    public function delete()
    {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 1) {
                $url = explode('/', $_SERVER['REQUEST_URI']);
                $numuser = $url[2];
                $this->userModel->userDelete($numuser);
                header('Location:/');
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
    }

    public function setAsAdmin()
    {
        if ($_SESSION['role'] == 1) {
            $this->userModel->setAsAdmin($numuser);
            header('Location: /user/' . $numuser . '');
        }
    }

    public function myPosts()
    {
        $currentPage = 1;
        $data = $this->userModel->myPosts($currentPage, $lastPage);
        $this->view->generateView('TemplateView.php', 'MyPostsView.php', $data, $currentPage, $lastPage);
    }
}