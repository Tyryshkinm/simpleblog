<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main</title>
</head>
<body>
<br>
<?php
$this->model = new Model();
$post = $this->model->post_page_output();
echo '<pre>';
var_dump($post);
echo '</pre>';
echo '<b>'."id: ".'</b>'.$post['id'].'<br>';
echo '<b>'."title: ".'</b>'.$post['title'].'<br>';
echo '<b>'."text: ".'</b>'.$post['text'].'<br>';
echo '<b>'."date: ".'</b>'.$post['date'].'<br>';
echo '<b>'."author: ".'</b>'.$post['author'].'<br>';
?>

</body>
</html>