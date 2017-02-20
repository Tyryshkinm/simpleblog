<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Application/Models/PostModel.php');
class UserModel extends Model
{
    public $userId;
    public $username;
    public $password;
    public $firstName;
    public $secondName;
    public $sex;

    public function userCheck($data)
    {
        $newUsername = $data['username'];
        $query = "SELECT username FROM users WHERE username = $newUsername";
        $this->executeQuery($query);
        $user = $this->sth -> fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function userRegistration($data)
    {
        $username = $data['username'];
        $password = $data['password'];
        $firstName = $data['firstName'];
        $secondName = $data['secondName'];
        $sex = $data['sex'];
        $query = "INSERT INTO users (username, password, firstName, secondName, sex) "
               . "VALUES ('$username', '$password', '$firstName', '$secondName', '$sex')";
        $this->executeQuery($query);
    }

    public function userLogin($data)
    {
        $username = $data['username'];
        $query = "SELECT id, username, password, role FROM users WHERE username = '$username'";
        $this->executeQuery($query);
        $user = $this->sth -> fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function userEdit($data)
    {
        $firstName = $data['firstName'];
        $secondName = $data['secondName'];
        $sex = $data['sex'];
        $password = $data['password'];
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numuser = $url[2];
        $query = "UPDATE users "
                . "SET firstName = '$firstName', secondName = '$secondName', password = '$password', sex = '$sex' "
                . "WHERE id = $numuser";
        $this->executeQuery($query);
    }

    public function userDelete($numuser)
    {
        $query = "DELETE FROM users WHERE id = $numuser";
        $this->executeQuery($query);
    }

    public function setAsAdmin(&$numuser)
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numuser = $url[2];
        $query = "UPDATE users SET role = 1 WHERE id = $numuser";
        $this->executeQuery($query);
    }

    public function userPageOutput()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numuser = $url[2];
        $query = "SELECT * FROM users WHERE id = $numuser";
        $this->executeQuery($query);
        $user = $this->sth -> fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function myPosts($currentPage, &$lastPage)
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numuser = $url[2];
        $start = 0+5*($currentPage-1);
        $countShowPosts = 5;
        $query = "SELECT COUNT(*) as count FROM posts WHERE author = '$numuser'";
        $this->executeQuery($query);
        $numberOfPosts = $this->sth -> fetchAll(PDO::FETCH_ASSOC);
        $numberOfPosts = $numberOfPosts[0]['count'];
        if ($numberOfPosts > 0) {
            $lastPage = ceil($numberOfPosts/$countShowPosts);
        } else {
            $lastPage = 1;
        }
        $posts = NULL;
        $query = "SELECT posts.id, title, text, date, author, firstName, secondName "
                . "FROM posts INNER JOIN users ON author = users.id "
                . "WHERE author = '$numuser'"
                . "ORDER BY date DESC "
                . "LIMIT $start, $countShowPosts";;
        $this->executeQuery($query);
        $myPosts = $this->sth -> fetchAll(PDO::FETCH_ASSOC);
        return $myPosts;
    }
}