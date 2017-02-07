<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User</title>
</head>
<body>
<br>
<?php

echo '<b>'."id: ".'</b>'.$data['id'].'<br>';
echo '<b>'."username: ".'</b>'.$data['username'].'<br>';
echo '<b>'."first name: ".'</b>'.$data['first_name'].'<br>';
echo '<b>'."second name: ".'</b>'.$data['second_name'].'<br>';
echo '<b>'."sex: ".'</b>'.$data['sex'].'<br>';
?>
<br>
<?php if (!empty($_SESSION['logged_user'])):?>
    <?php if ($_SESSION['user_id'] == $data['id'] or $_SESSION['role'] == 1):?>
        <form method="post" action="/user/<?=$data['id']?>/edit">
            <input type="submit" value="Edit user" />
        </form>
    <?php endif;?>
    <?php if ($_SESSION['role'] == 1):?>
        <form method="post" action="/user/<?=$data['id']?>/delete">
            <input type="submit" value="Delete user"?>
        </form>
    <?php endif;?>
    <?php if ($_SESSION['role'] == 1 and $_SESSION['user_id']!=$data['id'] and $data['role'] == 0):?>
        <form method="post" action="/user/<?=$data['id']?>/set_as_admin">
            <input type="submit" value="Set as Admin">
        </form>
    <?php endif;?>
<?php endif;?>
</body>
</html>