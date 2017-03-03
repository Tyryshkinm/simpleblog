<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Application/Models/UserModel.php');
class PostModel extends model
{
    public function postAdd($data)
    {
        $title = $data['title'];
        $text = $data['text'];
        $authorId = $_SESSION['userId'];
        $query = "INSERT INTO posts (title, text, date, author) "
               . "VALUES ('$title', '$text', current_timestamp(), '$authorId')";
        $this->executeQuery($query);
    }

    public function postOutput($currentPage, &$lastPage, $amt)
    {
        $start = 0 + $amt * ($currentPage - 1);
        $countShowPosts = $amt;
        $query = "SELECT COUNT(*) as count FROM posts";
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
                . "FROM posts INNER JOIN users ON author = users.id ORDER BY date DESC "
                . "LIMIT $start, $countShowPosts";
        $this->executeQuery($query);
        $posts = $this->sth->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }

    public function postPageOutput()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numpost = $url[2];
        $query = "SELECT * FROM posts WHERE id = $numpost";
        $this->executeQuery($query);
        $posts = $this->sth -> fetch(PDO::FETCH_ASSOC);
        $userId =  $posts['author'];
        $query = "SELECT firstName, secondName FROM users WHERE id = $userId";
        $this->executeQuery($query);
        $author = $this->sth->fetch(PDO::FETCH_ASSOC);
        $posts = array_merge($posts, $author);
        return $posts;
    }

    public function postEdit($data)
    {
        $title = $data['title'];
        $text = $data['text'];
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numpost = $url[2];
        $query = "UPDATE posts SET title = '$title', text = '$text', date = date WHERE id = $numpost";
        $this->executeQuery($query);
        return $numpost;
    }

    public function verificationAuthorOfPost(&$numpost)
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $numpost = $url[2];
        $query = "SELECT author FROM posts WHERE id = $numpost";
        $this->executeQuery($query);
        $authorId = $this->sth->fetch(PDO::FETCH_ASSOC);
        return $authorId;
    }

    public function postDelete($numpost)
    {
        $query = "DELETE FROM posts WHERE id = $numpost";
        $this->executeQuery($query);
    }

    public function search($search)
    {
        $query = "SELECT id, title FROM posts WHERE title LIKE replace('%$search%', 'chr(194).chr(160)', '')";
        $this->executeQuery($query);
        $searchedTitles = $this->sth->fetchAll(PDO::FETCH_ASSOC);
        return $searchedTitles;
    }
}

