<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User</title>
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
<br>
<?php if (!empty($_SESSION['logged_user'])):?>
<?php if ($_SESSION['user_id'] == $user['id'] or $_SESSION['role'] == 1):?>
    <form method="post" action="/user/<?=$user['id']?>/edit">
        <input type="submit" value="Edit user" />
    </form>
<?php endif;?>
<?php if ($_SESSION['role'] == 1):?>
    <form method="post" action="/user/<?=$user['id']?>/delete">
        <input type="submit" value="Delete user"?>
    </form>
<?php endif;?>
<?php if ($_SESSION['role'] == 1 and $_SESSION['user_id']!=$user['id'] and $user['role'] == 0):?>
    <form method="post" action="/user/<?=$user['id']?>/set_as_admin">
        <input type="submit" value="Set as Admin">
    </form>
<?php endif;?>
<?php endif;?>
</body>
</html>