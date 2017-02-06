<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main</title>
</head>
<body>

<?php
$this->model = new Model();
$posts = $this->model->post_output();

?>
<?php if (isset($posts) and is_array($posts)):?>
<?php foreach ($posts as $post):?>
    <br>
    <b>id: </b><?=$post['id']?><br>
    <b>titile: </b><a href="/post/<?=$post['id']?>"><?=$post['title']?></a><br>
    <b>text: </b><?=mb_substr($post['text'], 0, 200, 'UTF-8')?>...<a href="/post/<?=$post['id']?>">read more</a><br>
    <b>date: </b><?=$post['date']?><br>
    <b>author: </b><a href="/user/<?=$post['author']?>"><?=$post['first_name'].' '.$post['second_name']?></a><br>
<?php endforeach;?>
<?php endif;?>

Пагинация
<form method="post" action="/">

    <input type="submit" name="first_page" value="first page">
    <input type="submit" name="1" value="1">
    <input type="submit" name="2" value="2">
    <input type="submit" name="3" value="3">
    <input type="submit" name="4" value="4">
    <input type="submit" name="5" value="5">
    <input type="submit" name="6" value="6">
    <input type="submit" name="7" value="7">
    <input type="submit" name="8" value="8">
    <input type="submit" name="9" value="9">
    <input type="submit" name="10" value="10">
    <input type="submit" name="11" value="11">
    <input type="submit" name="last_page" value="last page">

</form>

</body>
</html>

