<?php

class PostModel extends model
{
    public function postAdd($data)
    {
        $title = $data['title'];
        $text = $data['text'];
        $authorId = $_SESSION['userId'];
        $db = $this->connectToDatabase();
        $query = "INSERT INTO posts (title, text, date, author) "
               . "VALUES ('$title', '$text', current_timestamp(), '$authorId')";
        $sth = $db->prepare($query);
        $sth->execute();
    }

    public function postOutput($currentPage, &$lastPage)
    {
        $start = 0+10*($currentPage-1);
        $countShowPosts = 10;
        $db = $this->connectToDatabase();
        $query1 = "SELECT COUNT(*) as count FROM posts";
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
        $query2 = "SELECT posts.id, title, text, date, author, firstName, secondName "
                . "FROM posts INNER JOIN users ON author = users.id ORDER BY date DESC "
                . "LIMIT $start, $countShowPosts";
        $sth = $db->prepare($query2);
        $sth->execute();
        $posts = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }

    public function postPageOutput()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numpost = $url[2];
        $db = $this->connectToDatabase();
        $query1 = "SELECT * FROM posts WHERE id = $numpost";
        $sth = $db->prepare($query1);
        $sth->execute();
        $posts = $sth -> fetch(PDO::FETCH_ASSOC);
        $userId =  $posts['author'];
        $query2 = "SELECT firstName, secondName FROM users WHERE id = $userId";
        $sth = $db->prepare($query2);
        $sth->execute();
        $author = $sth->fetch(PDO::FETCH_ASSOC);
        $posts = array_merge($posts, $author);
        return $posts;
    }

    public function postEdit($data)
    {
        $title = $data['title'];
        $text = $data['text'];
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numpost = $url[2];
        $db = $this->connectToDatabase();
        $query1 = "UPDATE posts SET title = '$title', text = '$text' WHERE id = $numpost";
        $sth = $db->prepare($query1);
        $sth->execute();
    }

    public function verificationAuthorOfPost(&$numpost)
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numpost = $url[2];
        $db = $this->connectToDatabase();
        $query1 = "SELECT author FROM posts WHERE id = $numpost";
        $sth = $db->prepare($query1);
        $sth->execute();
        $authorId = $sth->fetch(PDO::FETCH_ASSOC);
        return $authorId;
    }

    public function postDelete($numpost)
    {
        $db = $this->connectToDatabase();
        $query1 = "DELETE FROM posts WHERE id = $numpost";
        $sth = $db->prepare($query1);
        $sth->execute();
    }
}

