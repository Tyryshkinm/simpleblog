<?php

class registration_model extends model
{
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
        $start = 0+10*($current_page-1);
        $count_show_posts = 10;
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
        header('Location: /post/'.$numpost.'');
    }

    public function post_delete()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numpost = $url[2];
        $db = $this->connect_to_db();
        $query1 = "DELETE FROM posts WHERE id = $numpost";//перенести в роут, нампост??
        $sth = $db->prepare($query1);
        $sth->execute();
    }
}

