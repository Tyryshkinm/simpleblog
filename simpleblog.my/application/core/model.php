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
        $username = $data['username'];
        $password = $data['password'];
        $first_name = $data['first_name'];
        $second_name = $data['second_name'];
        $sex = $data['sex'];
        $query = "INSERT INTO users (username, password, first_name, second_name, sex) VALUES ('$username', '$password', '$first_name', '$second_name', '$sex')";
        $sth = $this->datab->prepare($query);
        $sth->execute();
    }

    public function user_login($data)
    {
        $this->connect_to_db();
        $username = $data['username'];
        $password = $data['password'];
        $query = "SELECT id, username, password, role FROM users WHERE username = '$username'";
        $sth = $this->datab->prepare($query);
        $sth->execute();
        $user = $sth -> fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function user_logout()
    {
        unset($_SESSION['logged_user']);
        unset($_SESSION['user_id']);
        unset($_COOKIE[session_name()]);
        session_regenerate_id();
        session_destroy();
    }

    /*считываем */
    public function user_check($data)
    {
        $this->connect_to_db();
        $new_username = $data['username'];
        $query = "SELECT username FROM users WHERE username = '$new_username'";
        $sth = $this->datab->prepare($query);
        $sth->execute();
        $user = $sth -> fetch(PDO::FETCH_ASSOC);
        return $user;
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
    public $current_page;
    public $last_page;
    public function paged_posts($page)
    {
        $this->current_page = $page;
    }
    public function last_page()
    {
        return $this->last_page;
    }

    /*Вывод всех постов на главной странице*/
    public function post_output()
    {
        $start = 0+2*($this->current_page-1);
        $count_show_posts = 2;
        $this->connect_to_db();
        $query1 = "SELECT COUNT(*) as count FROM posts";
        $sth = $this->datab->prepare($query1);
        $sth->execute();
        $number_of_posts = $sth -> fetchAll(PDO::FETCH_ASSOC);
        $number_of_posts = $number_of_posts[0]['count'];
        if ($number_of_posts > 0)
        {
            $this->last_page = ceil($number_of_posts/$count_show_posts);
        }else $this->last_page = 1;
        $posts = NULL;
        $query2 = "SELECT posts.id, title, text, date, author, first_name, second_name 
                  FROM posts INNER JOIN users ON author = users.id ORDER BY date DESC 
                  LIMIT $start, $count_show_posts";
        $sth = $this->datab->prepare($query2);
        $sth->execute();
        $posts = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
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
