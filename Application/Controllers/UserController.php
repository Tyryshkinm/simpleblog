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
            $data['username'] = $_POST['username'];
            $data['email'] = $_POST['email'];
            $data['password'] = $_POST['password'];
            $data['firstName'] = $_POST['firstName'];
            $data['secondName'] = $_POST['secondName'];
            $data['sex'] = $_POST['sex'];
            if ($data['password'] == $_POST['repeatPassword']) {
                $user = $this->userModel->userCheck($data);
                if ($data['username'] == $user['username']) {
                    $this->view->msgError = 'A person with this username already exists';
                } else {
                    $this->userModel->userRegistration($data);
                    Route::redirekt($controller = 'user', $action = 'login', $parametr = NULL);
                }
            } else {
                $this->view->msgError = 'Passwords do not match';
            }
        }
        $this->view->generateView('TemplateView.php', 'UserRegistrationView.php', $data = NULL, $this->view->msgError);
    }

    public function login()
    {
        if (isset($_POST['login'])) {
            $data['username'] = $_POST['username'];
            $data['password'] = $_POST['password'];
            session_regenerate_id();
            $user = $this->userModel->userLogin($data);
            if ($user === false) {
                $this->view->msgError = 'Invalid username or password';
            } else {
                if ($data['password'] == $user['password']) {
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
        $data = $this->userModel->userPageOutput();
        if (isset($_POST['save'])) {
            if (!empty($_POST['oldPassword'])) {
                if ($_POST['oldPassword'] == $data['password']) {
                    if ($_POST['password'] == $_POST['repeatPassword']) {
                        if ($_POST['password'] != $_POST['oldPassword']) {
                            $data['email'] = $_POST['email'];
                            $data['password'] = $_POST['password'];
                            $data['firstName'] = $_POST['firstName'];
                            $data['secondName'] = $_POST['secondName'];
                            $data['sex'] = $_POST['sex'];
                            if (!empty($data['password'])) {
                                $this->userModel->userEdit($data);
                                header('Location:/user/' . $data['id'] . '');
                            } else {
                                $this->view->msgError = 'Password can not be empty';
                            }
                        } else {
                            $this->view->msgError = 'The new password must differ from the old';
                        }

                    } else {
                        $this->view->msgError = 'Passwords do not match';
                    }
                } else {
                    $this->view->msgError = 'The old password is not correct';
                }
            } else {
                $data['email'] = $_POST['email'];
                $data['firstName'] = $_POST['firstName'];
                $data['secondName'] = $_POST['secondName'];
                $data['sex'] = $_POST['sex'];
                $this->userModel->userEdit($data);
                Route::redirekt($controller = 'user', $action = '' . $data['id'] . '', $parametr = NULL);
            }
        }

        if (isset($_SESSION['userId'])) {
            $userId['id'] = $data['id'];
            if ($_SESSION['userId'] == $userId['id']) {
                $data = $this->userModel->userPageOutput();
                $this->view->generateView('TemplateView.php', 'UserEditView.php', $data, $this->view->msgError);
            } elseif ($_SESSION['role'] == 1) {
                $data = $this->userModel->userPageOutput();
                $this->view->generateView('TemplateView.php', 'UserEditView.php', $data, $this->view->msgError);
            } else {
                $this->view->msgError = 'You have not permissions';
                $this->view->generateView('TemplateView.php', '404View.php', $data = NULL, $this->view->msgError);
            }
        } else {
            $this->view->msgError = 'You have not permissions';
            $this->view->generateView('TemplateView.php', '404View.php',
                $data = NULL, $this->view->msgError);
        }
    }

    public function delete()
    {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 1) {
                $url = explode('/', $_SERVER['REQUEST_URI']);
                $numuser = $url[2];
                $this->userModel->userDelete($numuser);
                Route::redirekt($controller = NULL, $action = NULL, $parametr = NULL);
            } else {
                $this->view->msgError = 'You have not permissions';
                $this->view->generateView('TemplateView.php', '404View.php', $data = NULL, $this->view->msgError);
            }
        } else {
            $this->view->msgError = 'You have not permissions';
            $this->view->generateView('TemplateView.php', '404View.php', $data = NULL, $this->view->msgError);
        }
    }

    public function setAsAdmin()
    {
        if ($_SESSION['role'] == 1) {
            $this->userModel->setAsAdmin($numuser);
            Route::redirekt($controller = 'user', $action = '' . $numuser . '', $parametr = NULL);
        }
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