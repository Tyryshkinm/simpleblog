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
    }

    public function user_login($data)
    {
        $this->connect_to_db();
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->user_entry();
    }

    public function user_logout()
    {
        unset($_SESSION['logged_user']);
        unset($_SESSION['user_id']);
        unset($_COOKIE[session_name()]);
        session_regenerate_id();
        session_destroy();
        header('Location:/  ');
    }

    public function user_entry($query = "SELECT id, username, password, role FROM users WHERE username = :username AND password = :password")
    {
        $sth = $this->datab->prepare($query);
        $sth->bindValue(':username', $this->username);
        $sth->bindValue(':password', $this->password);
        $sth->execute();
        $user = $sth -> fetch(PDO::FETCH_ASSOC);
        $_SESSION['logged_user'] = $user['username']; //записываем юзернейм и айди при входе на сайт
        $_SESSION['user_id'] = $user['id']; //записываем юзернейм и айди при входе на сайт
        $_SESSION['role'] = $user['role'];
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
    }

    /*считываем */
    public function user_check($query = "SELECT id, username FROM users WHERE username = :username")
    {
        $sth = $this->datab->prepare($query);
        $sth->bindValue(':username', $this->username);
        $sth->execute();
        $user = $sth -> fetch(PDO::FETCH_ASSOC);
        echo $this->username_db = $user['username'];
    }

    /*добавление поста в бд*/
    public $title;
    public $text;
    public $author;
    public function post_insert()
    {
        $query = "INSERT INTO posts (title, text, date, author) VALUES (:title, :text, current_timestamp(), :author)";
        $sth = $this->datab->prepare($query);
        $sth->bindValue(':title', $this->title);
        $sth->bindValue(':text', $this->text);
        $sth->bindValue(':author', $_SESSION['user_id']);
        $sth->execute();
    }

    /*добавление поста*/
    public function post_add($data)
    {
        $this->connect_to_db();
        $this->title = $data['title'];
        $this->text = $data['text'];
        $this->post_insert();
        header('Location: /');
    }

    /*пагинация*/
    public function paged_posts()
    {
        
    }

    /*Вывод всех постов на главной странице*/
    public function post_output()
    {
        $this->connect_to_db();
        $all_posts = NULL;
        $query1 = "SELECT COUNT(*) as count FROM posts";
        $sth = $this->datab->prepare($query1);
        $sth->execute();
        $number_of_posts = $sth -> fetchAll(PDO::FETCH_ASSOC);
        $number_of_posts = $number_of_posts[0]['count'];//общее кол-во постов
      //  $count_show_pages = 10;


        $query2 = "SELECT id FROM posts";
        $sth = $this->datab->prepare($query2);
        $sth->execute();
        $all_id_posts = $sth->fetchAll(PDO::FETCH_ASSOC);
        for ($i = $number_of_posts-1; $i>=0; $i--)
        {
            $id[$i] = $all_id_posts[$i];
            $j = $id[$i]['id'];
            $query3 = "SELECT id, title, text, date, author FROM posts WHERE id = $j";
            $sth = $this->datab->prepare($query3);
            $sth->execute();
            $posts = $sth->fetch(PDO::FETCH_ASSOC);
            $author = $posts['author'];
            $query4 = "SELECT first_name, second_name FROM users WHERE id = $author";
            $sth = $this->datab->prepare($query4);
            $sth->execute();
            $full_author = $sth->fetch(PDO::FETCH_ASSOC);
            $all_posts[$i] = array_merge($posts, $full_author);
        }
        return $all_posts;
    }

    /*Вывод страницы поста*/
    public function post_page_output()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numpost = $url[2];
        $this->connect_to_db();
        $query1 = "SELECT * FROM posts WHERE id = $numpost";
        $sth = $this->datab->prepare($query1);
        $sth->execute();
        $posts = $sth -> fetch(PDO::FETCH_ASSOC);
        $user_id =  $posts['author'];
        $query2 = "SELECT first_name, second_name FROM users WHERE id = $user_id";
        $sth = $this->datab->prepare($query2);
        $sth->execute();
        $author = $sth->fetch(PDO::FETCH_ASSOC);
        $posts = array_merge($posts, $author);
        return $posts;
    }

    /*Вывод страницы пользователя*/
    public function user_page_output()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numuser = $url[2];
        $this->connect_to_db();
        $query1 = "SELECT * FROM users WHERE id = $numuser";
        $sth = $this->datab->prepare($query1);
        $sth->execute();
        $user = $sth -> fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    /*Редактирование поста*/
    public function post_edit($data)
    {
        $title = $data['title'];
        $text = $data['text'];
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numpost = $url[2];
        $this->connect_to_db();
        $query1 = "UPDATE posts SET title = '$title', text = '$text' WHERE id = $numpost";
        $sth = $this->datab->prepare($query1);
        $sth->execute();
        header('Location: /post/'.$numpost.'');
    }

    public function post_delete()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numpost = $url[2];
        $this->connect_to_db();
        $query1 = "DELETE FROM posts WHERE id = $numpost";
        $sth = $this->datab->prepare($query1);
        $sth->execute();
        header('Location:/');
    }

    /*Редактирование юзера*/
    public function user_edit($data)
    {
        $fn = $data['first_name'];
        $sn = $data['second_name'];
        $sex = $data['sex'];
        $pass = $data['password'];
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numuser = $url[2];
        $this->connect_to_db();
        $query1 = "UPDATE users SET first_name = '$fn', second_name = '$sn', password = '$pass', sex = '$sex' WHERE id = $numuser";
        $sth = $this->datab->prepare($query1);
        $sth->execute();
    }

    /*Удаление пользователя*/
    public function user_delete()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numuser = $url[2];
        $this->connect_to_db();
        $query1 = "DELETE FROM posts WHERE author = $numuser";
        $sth = $this->datab->prepare($query1);
        $sth->execute();
        $query2 = "DELETE FROM users WHERE id = $numuser";
        $sth = $this->datab->prepare($query2);
        $sth->execute();
        header('Location:/');
    }

    /*Даем права админа юзеру*/
    public function set_as_admin()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numuser = $url[2];
        $this->connect_to_db();
        $query1 = "UPDATE users SET role = 1 WHERE id = $numuser";
        $sth = $this->datab->prepare($query1);
        $sth->execute();
        header('Location: /user/'.$numuser.'');
    }
}
