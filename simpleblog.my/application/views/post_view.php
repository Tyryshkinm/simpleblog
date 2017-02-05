<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post</title>
</head>
<body>

<?php
$this->model = new Model();
$post = $this->model->post_page_output();
?>

<br>
<b>id: </b><?=$post['id']?><br>
<b>titile: </b><?=$post['title']?><br>
<b>text: </b><?=$post['text']?><br>
<b>date: </b><?=$post['date']?><br>
<b>author: </b><a href="/user/<?=$post['author']?>"><?=$post['first_name'].' '.$post['second_name']?></a><br>

<br>
<?php if ($_SESSION['user_id'] == $post['author']):?>
    <form method="post" action="/post/<?=$post['id']?>/edit">
        <input type="submit" value="Edit post" />
    </form>
    <form method="post" action="/post/<?=$post['id']?>/delete">
        <input type="submit" value="Delete post"?>
    </form>
<?php endif;?>


</body>
</html>