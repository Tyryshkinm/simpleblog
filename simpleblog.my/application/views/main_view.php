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

<?php foreach ($posts as $post):?>
    <br>
    <b>id: </b><?=$post['id']?><br>
    <b>titile: </b><a href="/post/<?=$post['id']?>"><?=$post['title']?></a><br>
    <b>text: </b><?=mb_substr($post['text'], 0, 200, 'UTF-8')?>...<a href="/post/<?=$post['id']?>">read more</a><br>
    <b>date: </b><?=$post['date']?><br>
    <b>author: </b><a href="/user/<?=$post['author']?>"><?=$post['first_name'].' '.$post['second_name']?></a><br>
<?php endforeach;?>

</body>
</html>

