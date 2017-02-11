<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="css/styles.css" type="text/css">
</head>
<body>

<?php if (isset($_SESSION['logged_user'])): ?>
    <?php echo "Hello, " . $_SESSION['logged_user'].", you are logged!".'</br>';?>
    <a href="/">Home</a>
    <a href="/addpost">Add_post</a>
    <a href="/login/logout_user">Logout</a>
    </br>

    <?php if (!empty($error)):?>
        <?=$error;?>
    <?php endif;?>

    <?php include 'application/views/'.$content_view;?>
<?php else: ?>
    <?php echo "You are not logged!".'</br>' ?>
    <a href="/">Home</a>
    <a href="/registration">Registration</a>
    <a href="/login">Login</a>
    </br>

    <?php if (!empty($error)):?>
        <?=$error;?>
    <?php endif;?>

    <?php include 'application/views/'.$content_view;?>
<?php endif;?>

</body>
</html>

