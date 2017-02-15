<?php

class UserModel extends Model
{
    public function userCheck($data)
    {
        $db = $this->connectToDatabase();
        $newUsername = $data['username'];
        $query = "SELECT username FROM users WHERE username = '$newUsername'";
        $sth = $db->prepare($query);
        $sth->execute();
        $user = $sth -> fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function userRegistration($data)
    {
        $db = $this->connectToDatabase();
        $username = $data['username'];
        $password = $data['password'];
        $firstName = $data['firstName'];
        $secondName = $data['secondName'];
        $sex = $data['sex'];
        $query = "INSERT INTO users (username, password, firstName, secondName, sex) "
               . "VALUES ('$username', '$password', '$firstName', '$secondName', '$sex')";
        $sth = $db->prepare($query);
        $sth->execute();
    }

    public function userLogin($data)
    {
        $db = $this->connectToDatabase();
        $username = $data['username'];
        $query = "SELECT id, username, password, role FROM users WHERE username = '$username'";
        $sth = $db->prepare($query);
        $sth->execute();
        $user = $sth -> fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function userLogout()//Вынести в контроллер
    {
        unset($_SESSION['loggedUser']);
        unset($_SESSION['userId']);
        unset($_COOKIE[session_name()]);
        session_regenerate_id();
        session_destroy();
    }

    public function userEdit($data)
    {
        $firstName = $data['firstName'];
        $secondName = $data['secondName'];
        $sex = $data['sex'];
        $password = $data['password'];
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numuser = $url[2];
        $db = $this->connectToDatabase();
        $query1 = "UPDATE users "
                . "SET firstName = '$firstName', secondName = '$secondName', password = '$password', sex = '$sex' "
                . "WHERE id = $numuser";
        $sth = $db->prepare($query1);
        $sth->execute();
    }

    public function userDelete($numuser)
    {
        $db = $this->connectToDatabase();
        $query2 = "DELETE FROM users WHERE id = $numuser";
        $sth = $db->prepare($query2);
        $sth->execute();
    }

    public function setAsAdmin(&$numuser)
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numuser = $url[2];
        $db = $this->connectToDatabase();
        $query1 = "UPDATE users SET role = 1 WHERE id = $numuser";
        $sth = $db->prepare($query1);
        $sth->execute();
    }

    public function userPageOutput()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numuser = $url[2];
        $db = $this->connectToDatabase();
        $query1 = "SELECT * FROM users WHERE id = $numuser";
        $sth = $db->prepare($query1);
        $sth->execute();
        $user = $sth -> fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function myPosts($currentPage, &$lastPage)
    {
        $userId = $_SESSION['userId'];
        $start = 0+10*($currentPage-1);
        $countShowPosts = 10;
        $db = $this->connectToDatabase();
        $query1 = "SELECT COUNT(*) as count FROM posts WHERE author = '$userId'";
        $sth = $db->prepare($query1);
        $sth->execute();
        $numberOfPosts = $sth -> fetchAll(PDO::FETCH_ASSOC);
        $numberOfPosts = $numberOfPosts[0]['count'];
        if ($numberOfPosts > 0) {
            $lastPage = ceil($numberOfPosts/$countShowPosts);
        } else {
            $lastPage = 1;
        }
        $posts = NULL;
        $db = $this->connectToDatabase();
        $query1 = "SELECT posts.id, title, text, date, author, firstName, secondName "
                . "FROM posts INNER JOIN users ON author = users.id "
                . "WHERE author = '$userId'"
                . "ORDER BY date DESC "
                . "LIMIT $start, $countShowPosts";;
        $sth = $db->prepare($query1);
        $sth->execute();
        $myPosts = $sth -> fetchAll(PDO::FETCH_ASSOC);
        return $myPosts;
    }
}