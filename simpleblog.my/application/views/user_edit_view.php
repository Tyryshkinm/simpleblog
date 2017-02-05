<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit user</title>
</head>
<body>

<?php
$this->model = new Model();
$user = $this->model->user_page_output();
?>
<br>
Edit user: <?=$user['username']?>

<form method="post" action="/user/<?=$user['id']?>/save_changes">

    <input type="text" name="first_name" value="<?=$user['first_name']?>" placeholder="first name" /><br>
    <input type="text" name="second_name" value="<?=$user['second_name']?>" placeholder="second name" /><br>
    <input type="password" name="old_password" placeholder="old password" /><br>
    <input type="password" name="password" placeholder="password" /><br>
    <input type="password" name="repeat_password" placeholder="repeat password" /><br>
    sex
    <select name="sex" required>
        <?php if ($user['sex']=='male'):?>
        <option value="male" selected >Male</option>
        <option value="female">Female</option>
        <?php else: ?>
        <option value="male">Male</option>
        <option value="female" selected >Female</option>
        <?php endif;?>
    </select><br><br>
    <input type="submit" name="save" value="Save" />

</form>

</body>
</html>