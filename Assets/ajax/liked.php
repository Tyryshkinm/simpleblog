<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Application/Core/Bootstrap.php');
$model = new Model();
$view = new View();
$postController = new PostController();
switch ($_POST['action']):
    case 'clickOnHeart':
    {
        $postId = $_POST['postId'];
        $userId = $_SESSION['userId'];
        $query1 = "SELECT id FROM likes WHERE user_id = $userId AND  post_id = $postId";
        $model->executeQuery($query1);
        $issetLike = $model->sth->fetch(PDO::FETCH_ASSOC);
        $issetLike = $issetLike['id'];
        if (!empty($issetLike)) {
            $query2 = "DELETE FROM likes WHERE id = $issetLike";
            $model->executeQuery($query2);
        } else {
            $query3 = "INSERT INTO likes (post_id, user_id) "
                . "VALUES ('$postId', '$userId')";
            $model->executeQuery($query3);
        }
        $limit = 5;
        $query4 = "SELECT username FROM likes INNER JOIN users ON user_id = users.id WHERE post_id = $postId LIMIT $limit";
        $model->executeQuery($query4);
        $data = $model->sth->fetchAll(PDO::FETCH_ASSOC);
        if (empty($data)) {
            echo NULL;
        } else {
            foreach ($data as $row)
            {
                echo $row['username'] . ' ';
            }
        }
        break;
    }

    case 'overHeart':
        $postId = $_POST['postId'];
        $limit = 5;
        if (isset($_POST['viewmore'])) {
            $count = $_POST['viewmore'];
            $limit = $limit + $count * 10;
        }
        $query2 = "SELECT username FROM likes INNER JOIN users ON user_id = users.id WHERE post_id = $postId LIMIT $limit";
        $model->executeQuery($query2);
        $data = $model->sth->fetchAll(PDO::FETCH_ASSOC);
        if (empty($data)) {
            echo NULL;
        } else {
            foreach ($data as $row)
            {
                echo $row['username'] . ' ';
            }
        }
        break;

    case 'outHeart':
        echo NULL;
        break;

endswitch;
