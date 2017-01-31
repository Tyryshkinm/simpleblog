<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main</title>
</head>
<body>

<?php echo "List of posts" ?><br>

<?php
$this->model = new Model();
$result = $this->model->post_output();
$j = $result[0]['count'];
for ($i = 1; $i <= $j; $i++)
    echo '<br>'."Название - ".$result[$i]['title'].'<br> Текст - '. $result[$i]['text'].'<br> Дата создания - '.$result[$i]['date'].'<br> Автор - '.$result[$i]['author'].'<br>';
//написать вывод постов
?>


</body>
</html>

