<?php

class user_model extends model
{
    public function user_check($data)
    {
        $db = $this->connect_to_db();
        $new_username = $data['username'];
        $query = "SELECT username FROM users WHERE username = '$new_username'";
        $sth = $db->prepare($query);
        $sth->execute();
        $user = $sth -> fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function user_registration($data)
    {
        $db = $this->connect_to_db();
        $username = $data['username'];
        $password = $data['password'];
        $first_name = $data['first_name'];
        $second_name = $data['second_name'];
        $sex = $data['sex'];
        $query = "INSERT INTO users (username, password, first_name, second_name, sex) VALUES ('$username', '$password', '$first_name', '$second_name', '$sex')";
        $sth = $db->prepare($query);
        $sth->execute();
    }

    public function user_login($data)
    {
        $db = $this->connect_to_db();
        $username = $data['username'];
        $query = "SELECT id, username, password, role FROM users WHERE username = '$username'";
        $sth = $db->prepare($query);
        $sth->execute();
        $user = $sth -> fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function user_logout()//Вынести в контроллер
    {
        unset($_SESSION['logged_user']);
        unset($_SESSION['user_id']);
        unset($_COOKIE[session_name()]);
        session_regenerate_id();
        session_destroy();
    }

    public function user_edit($data)
    {
        $first_name = $data['first_name'];
        $second_namen = $data['second_name'];
        $sex = $data['sex'];
        $password = $data['password'];
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numuser = $url[2];
        $db = $this->connect_to_db();
        $query1 = "UPDATE users SET first_name = '$first_name', second_name = '$second_namen', password = '$password', sex = '$sex' WHERE id = $numuser";
        $sth = $db->prepare($query1);
        $sth->execute();
    }

    public function user_delete()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numuser = $url[2];
        $db = $this->connect_to_db();
        $query2 = "DELETE FROM users WHERE id = $numuser";
        $sth = $db->prepare($query2);
        $sth->execute();
    }

    public function set_as_admin()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numuser = $url[2];
        $db = $this->connect_to_db();
        $query1 = "UPDATE users SET role = 1 WHERE id = $numuser";
        $sth = $db->prepare($query1);
        $sth->execute();
        header('Location: /user/'.$numuser.'');//перенести в роут, намюзер??
    }

    public function user_page_output()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numuser = $url[2];
        $db = $this->connect_to_db();
        $query1 = "SELECT * FROM users WHERE id = $numuser";
        $sth = $db->prepare($query1);
        $sth->execute();
        $user = $sth -> fetch(PDO::FETCH_ASSOC);
        return $user;
    }
}