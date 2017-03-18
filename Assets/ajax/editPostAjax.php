<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Application/Core/Bootstrap.php');
$model = new Model();
$view = new View();
$postController = new PostController();
switch ($_POST['action']):
    case 'clickOnPencil':
    {
        $postId = $_POST['postId'];
        $query1 = "SELECT title, text FROM posts WHERE id = $postId";
        $model->executeQuery($query1);
        $dataPost = $model->sth->fetch(PDO::FETCH_ASSOC);
        $dataText = $dataPost['text'];
        $dataTitle = $dataPost['title'];
        echo   '<div class="postEdit">
                    <input type="text" id="editTitle' . $postId . '" maxlength="50" name="postTitle" value="' . $dataTitle . '" placeholder="Title of Post" required /></br>
                    <textarea id="editText' . $postId . '" name="postText" cols="25" rows="10" placeholder="Text of Post" required >' . $dataText . '</textarea></br>
                    <button class="btn btn-primary">Save</button>
                </div>';
        break;
    }
    case 'clickOnSave':
    {
        $postId = $_POST['postId'];
        $title = $_POST['title'];
        $text = $_POST['text'];
        $query2 = "UPDATE posts SET title = '$title', text = '$text', date = date WHERE id = $postId";
        $model->executeQuery($query2);
    }
endswitch;