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

    public function likedPostsByUser($userId, $data)
    {
        $query = "SELECT post_id FROM likes WHERE user_id = $userId";
        $this->executeQuery($query);
        $likedPostsIds = $this->sth->fetchAll(PDO::FETCH_COLUMN);
        for ($i = 0; $i < count($data); $i++)
        {
            $post[$i] = $data[$i]['id'];
        }
        $_SESSION['likedPosts'] = array_intersect($likedPostsIds, $post);
        $_SESSION['countLikesOnPage'] = count($data);
    }
    public function likedPosts($data)
    {
        $query = "SELECT DISTINCT post_id FROM likes ORDER BY post_id";
        $this->executeQuery($query);
        $likedPosts = $this->sth->fetchAll(PDO::FETCH_COLUMN);
        for ($i = 0; $i < count($data); $i++)
        {
            $post[$i] = $data[$i]['id'];
        }
        $likedPosts = array_intersect($likedPosts, $post);
        return $likedPosts;
    }

    public function clickOnPencil($postId)
    {
        $query = "SELECT title, text FROM posts WHERE id = $postId";
        $this -> executeQuery($query);
        $dataPost = $this->sth->fetch(PDO::FETCH_ASSOC);
        return $dataPost;
    }

    public function clickOnSave($postId, $title, $text)
    {
        $query2 = "UPDATE posts SET title = '$title', text = '$text', date = date WHERE id = $postId";
        $this->executeQuery($query2);
    }

    public function clickOnHeart($postId, $userId, &$limit)
    {
        $query1 = "SELECT id FROM likes WHERE user_id = $userId AND  post_id = $postId";
        $this->executeQuery($query1);
        $issetLike = $this->sth->fetch(PDO::FETCH_ASSOC);
        $issetLike = $issetLike['id'];
        if (!empty($issetLike)) {
            $query2 = "DELETE FROM likes WHERE id = $issetLike";
            $this->executeQuery($query2);
        } else {
            $query3 = "INSERT INTO likes (post_id, user_id) "
                . "VALUES ('$postId', '$userId')";
            $this->executeQuery($query3);
        }
        $limit = 6;
        $query4 = "SELECT username, user_id FROM likes INNER JOIN users ON user_id = users.id WHERE post_id = $postId LIMIT $limit";
        $this->executeQuery($query4);
        $data = $this->sth->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function overHeart($postId, $limit)
    {
        $query = "SELECT username, user_id FROM likes INNER JOIN users ON user_id = users.id WHERE post_id = $postId LIMIT $limit";
        $this->executeQuery($query);
        $data = $this->sth->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}

