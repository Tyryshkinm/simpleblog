<?php

class model
{
    public function connect_to_db($username = 'root', $password = '258789', $host = 'localhost', $dbname = 'simpleblog_db')
    {
        $db = new PDO("mysql:host={$host}; dbname={$dbname};", $username, $password);
        return $db;
    }

    /*-----------------------------------------------------ВСЕ ЧТО ОТНОСИТСЯ К ЮЗЕРУ-----------------------------------------------------------------------------------*/

    public function user_check($data)
    {
        $db = $this->connect_to_db();
        $new_username = $data['username'];
        $query = "SELECT username FROM users WHERE username = '$new_username'";
        $sth = $db->prepare($query);
        //$sth = $this->datab->prepare($query);
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

    public function user_logout()
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

    /*-----------------------------------------------------ВСЕ ЧТО ОТНОСИТСЯ К ПОСТУ----------------------------------------------------------------*/

    public function post_add($data)
    {
        $title = $data['title'];
        $text = $data['text'];
        $author_id = $_SESSION['user_id'];
        $db = $this->connect_to_db();
        $query = "INSERT INTO posts (title, text, date, author) VALUES ('$title', '$text', current_timestamp(), '$author_id')";
        $sth = $db->prepare($query);
        $sth->execute();
    }

    public function post_output($current_page, &$last_page)
    {
        $start = 0+5*($current_page-1);
        $count_show_posts = 5;
        $db = $this->connect_to_db();
        $query1 = "SELECT COUNT(*) as count FROM posts";
        $sth = $db->prepare($query1);
        $sth->execute();
        $number_of_posts = $sth -> fetchAll(PDO::FETCH_ASSOC);
        $number_of_posts = $number_of_posts[0]['count'];
        if ($number_of_posts > 0)
        {
            $last_page = ceil($number_of_posts/$count_show_posts);
        }else $last_page = 1;
        $posts = NULL;
        $query2 = "SELECT posts.id, title, text, date, author, first_name, second_name 
                  FROM posts INNER JOIN users ON author = users.id ORDER BY date DESC 
                  LIMIT $start, $count_show_posts";
        $sth = $db->prepare($query2);
        $sth->execute();
        $posts = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }

    public function post_page_output()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numpost = $url[2];
        $db = $this->connect_to_db();
        $query1 = "SELECT * FROM posts WHERE id = $numpost";
        $sth = $db->prepare($query1);
        $sth->execute();
        $posts = $sth -> fetch(PDO::FETCH_ASSOC);
        $user_id =  $posts['author'];
        $query2 = "SELECT first_name, second_name FROM users WHERE id = $user_id";
        $sth = $db->prepare($query2);
        $sth->execute();
        $author = $sth->fetch(PDO::FETCH_ASSOC);
        $posts = array_merge($posts, $author);
        return $posts;
    }

    public function post_edit($data)
    {
        $title = $data['title'];
        $text = $data['text'];
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numpost = $url[2];
        $db = $this->connect_to_db();
        $query1 = "UPDATE posts SET title = '$title', text = '$text' WHERE id = $numpost";
        $sth = $db->prepare($query1);
        $sth->execute();
        header('Location: /post/'.$numpost.'');//перенести в роут, нампост??
    }

    public function verificationAuthorOfPost(&$numpost)
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numpost = $url[2];
        $db = $this->connect_to_db();
        $query1 = "SELECT author FROM posts WHERE id = $numpost";
        $sth = $db->prepare($query1);
        $sth->execute();
        $author_id = $sth->fetch(PDO::FETCH_ASSOC);
        return $author_id;
    }

    public function post_delete($numpost)
    {
        $db = $this->connect_to_db();
        $query1 = "DELETE FROM posts WHERE id = $numpost";
        $sth = $db->prepare($query1);
        $sth->execute();
    }
}
