<?php

class model
{
    public $isConn;
    public $datab;
    public $username;
    public $password;
    public $first_name;
    public $second_name;
    public $password_db;

    public function connect_to_db($username = "root", $password = "258789", $host = "localhost", $dbname = "simpleblog_db")
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
        $this->insert_user();
        header('Location:/login');
    }

    public function insert_user($query = "INSERT INTO users (username, password, first_name, second_name) VALUES (:username, :password, :first_name, :second_name)")
    {
        $sth = $this->datab->prepare($query);
        $sth->bindValue(':username', $this->username);
        $sth->bindValue(':password', $this->password);
        $sth->bindValue(':first_name', $this->first_name);
        $sth->bindValue(':second_name', $this->second_name);
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
}
