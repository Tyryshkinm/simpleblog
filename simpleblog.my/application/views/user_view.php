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
$user = $this->model->user_page_output();
echo '<b>'."id: ".'</b>'.$user['id'].'<br>';
echo '<b>'."username: ".'</b>'.$user['username'].'<br>';
echo '<b>'."first name: ".'</b>'.$user['first_name'].'<br>';
echo '<b>'."second name: ".'</b>'.$user['second_name'].'<br>';
echo '<b>'."sex: ".'</b>'.$user['sex'].'<br>';
?>

</body>
</html>