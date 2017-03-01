<?php

class UserController extends Controller
{
    public function index()
    {
        $data = $this->userModel->userPageOutput();
        if (is_array($data)) {
            $this->view->generateView('TemplateView.php', 'UserView.php', $data);
        } else {
            $this->view->generateView('TemplateView.php', '404View.php');
        }
    }

    public function registration()
    {
        if (isset($_POST['register'])) {
            $data['sex'] = $_POST['sex'];
            $data['username'] = trim($_POST['username']);
            $data['email'] = trim($_POST['email']);
            $data['firstName'] = trim($_POST['firstName']);
            $data['secondName'] = trim($_POST['secondName']);
            $data['password'] = trim($_POST['password']);
            if (!empty($data['username'])) {
                if (!empty($data['email'])) {
                    if (!empty($data['firstName'])) {
                        if (!empty($data['secondName'])) {
                            if (!empty($data['password'])) {
                                if ($data['password'] == $_POST['repeatPassword']) {
                                    $user = $this->userModel->userCheck($data);
                                    if ($data['username'] == $user['username']) {
                                        $this->view->msgError = 'A person with this username already exists';
                                    } else {
                                        $this->userModel->userRegistration($data);
                                        Route::redirekt($controller = 'user', $action = 'login', $parametr = NULL);
                                    }
                                } else {
                                    $this->view->msgError = 'Passwords do not match!';
                                }
                            } else {
                                $this->view->msgError = 'Password is empty!';
                            }
                        } else {
                            $this->view->msgError = 'Second name is empty!';
                        }
                    } else {
                        $this->view->msgError = 'First name is empty!';
                    }
                } else {
                    $this->view->msgError = 'Email is empty!';
                }
            } else {
                $this->view->msgError = 'Username is empty!';
            }
        }
        $this->view->generateView('TemplateView.php', 'UserRegistrationView.php', $data = NULL, $this->view->msgError);
    }

    public function login()
    {
        if (isset($_POST['login'])) {
            $data['username'] = $_POST['username'];
            $data['password'] = $_POST['password'];
            $user = $this->userModel->userLogin($data);
            if ($user === false) {
                $this->view->msgError = 'Invalid username or password';
            } else {
                if ($data['password'] == $user['password']) {
                    session_regenerate_id();
                    $_SESSION['loggedUser'] = $user['username'];
                    $_SESSION['userId'] = $user['id'];
                    $_SESSION['role'] = $user['role'];
                    Route::redirekt($controller = NULL, $action = NULL, $parametr = NULL);
                } else {
                    $this->view->msgError = 'Invalid username or password';
                }
            }
        }
        $this->view->generateView('TemplateView.php', 'UserLoginView.php', $data = NULL, $this->view->msgError);
    }

    public function logout()
    {
        unset($_SESSION['loggedUser']);
        unset($_SESSION['userId']);
        unset($_COOKIE[session_name()]);
        session_regenerate_id();
        session_destroy();
        Route::redirekt($controller = NULL, $action = NULL, $parametr = NULL);
    }

    public function edit()
    {
        if (isset($_SESSION['userId'])) {
            $url = explode('/', $_SERVER['REQUEST_URI']);
            $numuser = $url[2];
            if ($_SESSION['userId'] == $numuser or $_SESSION['role'] == 1) {
                $this->view->data = $this->userModel->userPageOutput();
                $this->view->contentView = 'UserEditView.php';
                if (isset($_POST['save']))
                {$data['email'] = trim($_POST['email']);
                    $data['firstName'] = trim($_POST['firstName']);
                    $data['secondName'] = trim($_POST['secondName']);
                    $data['sex'] = $_POST['sex'];
                    $oldPass = trim($_POST['oldPassword']);
                    if (!empty($data['email'])) {
                        if (!empty($data['firstName'])) {
                            if (!empty($data['secondName'])) {
                                if (!empty($oldPass)) {
                                    if ($oldPass == $this->view->data['password']) {
                                        $data['password'] = trim($_POST['password']);
                                        if ($data['password'] == $_POST['repeatPassword']) {
                                            $this->userModel->userEdit($data);
                                            Route::redirekt($controller = 'user', $action = '' . $this->view->data['id'] . '', $parametr = NULL);
                                        } else {
                                            $this->view->contentView = 'UserEditView.php';
                                            $this->view->msgError = 'Passwords do not match!';
                                        }
                                    } else {
                                        $this->view->contentView = 'UserEditView.php';
                                        $this->view->msgError = 'Old password is not correct!';
                                    }
                                } else {
                                    $data['password'] = $this->view->data['password'];
                                    $this->userModel->userEdit($data);
                                    Route::redirekt($controller = 'user', $action = '' . $this->view->data['id'] . '', $parametr = NULL);
                                }
                            } else {
                                $this->view->contentView = 'UserEditView.php';
                                $this->view->msgError = 'Second name is empty!';
                            }
                        } else {
                            $this->view->contentView = 'UserEditView.php';
                            $this->view->msgError = 'First name is empty!';
                        }
                    } else {
                        $this->view->contentView = 'UserEditView.php';
                        $this->view->msgError = 'Email is empty!';
                    }
                }
            } else {
                $this->view->contentView = '404View.php';
            }
        } else {
            $this->view->contentView = '404View.php';
        }
        $data = $this->view->data;
        $this->view->generateView('TemplateView.php', $this->view->contentView, $data, $this->view->msgError);
    }

    public function delete()
    {
        if (isset($_SESSION['role']) and $_SESSION['role'] == 1) {
            $url = explode('/', $_SERVER['REQUEST_URI']);
            $numuser = $url[2];
            $this->userModel->userDelete($numuser);
            Route::redirekt($controller = NULL, $action = NULL, $parametr = NULL);
        } else {
            $this->view->generateView('TemplateView.php', '404View.php');
        }
    }

    public function setAsAdmin()
    {
        if (isset($_SESSION['role']) and $_SESSION['role'] == 1) {
            $this->userModel->setAsAdmin($numuser);
            Route::redirekt($controller = 'user', $action = '' . $numuser . '', $parametr = NULL);
        }
        $this->view->generateView('TemplateView.php', '404View.php');
    }

    public function myPosts()
    {
        if (isset($_GET['page'])) {
            $currentPage = $_GET['page'];
            $data = $this->userModel->myPosts($currentPage, $lastPage);
            $this->view->generateView('TemplateView.php', 'MyPostsView.php', $data);
            $this->view->generatePagination('PaginationView.php', $currentPage, $lastPage);
        } else {
            $data = $this->userModel->myPosts($currentPage = 1, $lastPage);
            $this->view->generateView('TemplateView.php', 'MyPostsView.php', $data);
            $this->view->generatePagination('PaginationView.php', $currentPage, $lastPage);
        }
    }

    public function resetPassEmail()
    {
        $this->view->generateView('TemplateView.php', 'UserForgotPassView.php', $data = NULL, $this->view->msgError);
        if (isset($_POST['send'])) {
            $token = mt_rand();
            $email = $_POST['email'];
            $this->userModel->insertToken($email, $token);
            $host = $_SERVER['HTTP_HOST'];
            $to = $email;
            $subject = 'Reset password on SimbleBlog';
            $msg = 'You have requested to reset the password on the SimpleBlog.'
                . "\r\n" . 'Click the link below to change your password.' . "\r\n"
                . "\r\n" . 'http://' . $host . '/user/restorePass?email=' . $email . "&token=" . $token;
            $headers  = "Content-type: text/plain; charset = UTF-8 \r\n";
            $headers .= "From: SimpleBlog <supp@simpleblog>\r\n";
            mail($to, $subject, $msg, $headers);
        }
    }

    public function restorePass()
    {
        if (isset($_GET['token']) and isset($_GET['email'])) {
            $this->view->generateView('TemplateView.php', 'UserRestorePassView.php', $data = NULL, $this->view->msgError);
            $email = $_GET['email'];
            $tokenDb = $this->userModel->selectToken($email);;
            if ($_GET['token'] == $tokenDb['token']) {
                if (isset($_POST['submit'])) {
                    $newPassword  = $_POST['newPassword'];
                    $rePassword = $_POST['repeatPassword'];
                    if ($newPassword == $rePassword) {
                        $this->userModel->resetPass($newPassword, $email);
                        $this->userModel->insertToken($email, $token = mt_rand());
                        Route::redirekt($controller = 'user', $action = 'login', $parametr = NULL);
                    } else {
                        $this->view->msgError = 'passwords do not match';
                    }
                }
            } else {
                $this->userModel->insertToken($email, $token = mt_rand());
                $this->view->msgError = 'Link is outdated, try again';
                Route::redirekt($controller = 'user', $action = 'resetPassEmail', $parametr = NULL);
            }
        }
    }
}