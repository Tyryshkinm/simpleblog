<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SimpleBlog</title>
    <link rel="stylesheet" href="../../css/styles.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../../bootstrap-3.3.2-dist/css/bootstrap.css">
    <script src="../../bootstrap-3.3.2-dist/js/bootstrap.js" type="text/javascript"></script>
</head>
<body>

<header>
    <nav>
        <ul>
            <?php if (isset($_SESSION['logged_user'])):?>
                <li><a href="/">Home</a></li>
                <li><a href="/post/add">Add post</a></li>
                <li><a href="/user/logout">Logout</a></li>
            <?php else:?>
                <li><a href="/">Home</a></li>
                <li><a href="/user/registration">Registration</a></li>
                <li><a href="/user/login">Login</a></li>
            <?php endif;?>
        </ul>
        <?php if (isset($_SESSION['logged_user'])):?>
            <p><?php echo "Hello, " . $_SESSION['logged_user'].", you are logged!".'</br>';?></p>
        <?php endif;?>
    </nav>

</header>

<article>
    <?php if (!empty($error)):?>
        <?=$error;?>
    <?php endif;?>
</article>

<footer>
    <?php include 'application/views/'.$content_view;?>
</footer>

</body>
</html>