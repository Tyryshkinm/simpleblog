<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Edit post</title>
</head>
<body>
<br>

<?php
$this->model = new Model();
$post = $this->model->post_page_output();
?>

Edit post
<form method="post" action="/post/<?=$post['id']?>/save_changes">
    <input type="text" name="post_title" value="<?=$post['title']?>" placeholder="Title of Post" required /></br>
    <textarea name="post_text" cols="25" rows="10" placeholder="Text of Post" required ><?=$post['text']?></textarea></br>
    <input type="submit" name="save" value="Save changes" />
</form>

</body>
</html>