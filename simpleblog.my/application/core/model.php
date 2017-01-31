<?php

class model
{
    public $username;
    public $password;
    public $first_name;
    public $second_name;
    public $sex;
    public $password_db;
    public $username_db;
    public $error;
    public $datab;

    public function connect_to_db($username = 'root', $password = '258789', $host = 'localhost', $dbname = 'simpleblog_db')
    {
        try{
            $this->datab = new PDO("mysql:host={$host}; dbname={$dbname};", $username, $password);
        }catch (PDOException $e){
            throw new Exception($e->getMessage());
        }
    }

    public function user_registration($data)
    {
        $this->connect_to_db();
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->first_name = $data['first_name'];
        $this->second_name = $data['second_name'];
        $this->sex = $data['sex'];
        $this->user_check();
        if ($this->username_db == $data['username'])
        {
            echo "A person with this username already exists";
        }
        else
        {
            $this->insert_user();
            header('Location:/login');
        }
    }

    public function insert_user($query = "INSERT INTO users (username, password, first_name, second_name, sex) VALUES (:username, :password, :first_name, :second_name, :sex)")
    {
        $sth = $this->datab->prepare($query);
        $sth->bindValue(':username', $this->username);
        $sth->bindValue(':password', $this->password);
        $sth->bindValue(':first_name', $this->first_name);
        $sth->bindValue(':second_name', $this->second_name);
        $sth->bindValue('sex', $this->sex);
        $sth->execute();
        $sth = NULL;
        $this->datab = NULL;
    }

    public function user_login($data)
    {
        $this->connect_to_db();
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->user_entry();
    }

    public function user_entry($query = "SELECT id, username, password FROM users WHERE username = :username AND password = :password")
    {
        $sth = $this->datab->prepare($query);
        $sth->bindValue(':username', $this->username);
        $sth->bindValue(':password', $this->password);
        $sth->execute();
        $user = $sth -> fetch(PDO::FETCH_ASSOC);
        $_SESSION['logged_user'] = $user['username']; //записываем юзернейм и айди при входе на сайт
        $_SESSION['user_id'] = $user['id']; //записываем юзернейм и айди при входе на сайт
        $this->password_db = $user['password'];
        if($user === false)
        {
            die ('Ivalid username or password');
        }
        else {
            if ($this->password == $this->password_db) {
                // header('Location:/main');
            } else {
                die ('Invalid username or password');
            }
        }
        $sth = NULL;
        $this->datab = NULL;
    }

    public function user_check($query = "SELECT id, username FROM users WHERE username = :username")
    {
        $sth = $this->datab->prepare($query);
        $sth->bindValue(':username', $this->username);
        $sth->execute();
        $user = $sth -> fetch(PDO::FETCH_ASSOC);
        $this->username_db = $user['username'];
    }


    public $title;
    public $text;
    public $author;
    public function post_insert()
    {
        //считываем автора
        $session_id = $_SESSION['user_id'];
        $query = "SELECT id, username, first_name, second_name FROM users WHERE id = $session_id";
        $sth = $this->datab->prepare($query);
        $sth->execute();
        $user = $sth -> fetch(PDO::FETCH_ASSOC);
        $this->first_name = $user['first_name'];
        $this->second_name = $user['second_name'];
        $this->author = $this->first_name ." ".$this->second_name;
        //добавляем пост в бд
        $query = "INSERT INTO posts (title, text, date, author) VALUES (:title, :text, current_timestamp(), :author)";
        $sth = $this->datab->prepare($query);
        $sth->bindValue(':title', $this->title);
        $sth->bindValue(':text', $this->text);
        $sth->bindValue(':author', $this->author);
        $sth->execute();
        $sth = NULL;
        $this->datab = NULL;
    }

    public function post_add($data)
    {
        $this->connect_to_db();
        $this->title = $data['title'];
        $this->text = $data['text'];
        $this->post_insert();
        header('Location: /');
    }

    public function post_output()
    {
        $this->connect_to_db();
        $query1 = "SELECT * FROM posts";
        $query2 = "SELECT COUNT(*) as count FROM posts";
        $sth = $this->datab->prepare($query1);
        $sth->execute();
        $posts = $sth -> fetchAll(PDO::FETCH_ASSOC);
        $sth = $this->datab->prepare($query2);
        $sth->execute();
        $rows = $sth -> fetchAll(PDO::FETCH_ASSOC);
        $result = array_merge($rows, $posts);
       // return $posts + $rows;
        return $result;
    }

}
