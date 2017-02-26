<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>SimpleBlog</title>
    <link rel="stylesheet" href="../../Css/styles.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../../bootstrap-3.3.2-dist/css/bootstrap.css">
    <script src="../../bootstrap-3.3.2-dist/js/bootstrap.js" type="text/javascript"></script>
</head>
<body>

<section class="error">
    <?php if (!empty($error)):?>
        <?=$error;?>
    <?php endif;?>
</section>

<header>
    <nav>
        <?php if (isset($_SESSION['loggedUser'])):?>
            <p><?php echo 'Hello, ' . '<a href="/user/'.$_SESSION['userId'] . '">' .  $_SESSION['loggedUser'] . '</a>' . ', you are logged!' . '</br>';?></p>
        <?php endif;?>
        <ul>
            <?php if (isset($_SESSION['loggedUser'])):?>
                <li><a href="/">Home</a></li>
                <li><a href="/post/search">Search</a></li>
                <li><a href="/user/<?=$_SESSION['userId'];?>/myPosts">My Posts</a></li>
                <li><a href="/post/add">Add Post</a></li>
                <li><a href="/user/logout">Logout</a></li>
            <?php else:?>
                <li><a href="/">Home</a></li>
                <li><a href="/post/search">Search</a></li>
                <li><a href="/user/registration">Registration</a></li>
                <li><a href="/user/login">Login</a></li>
            <?php endif;?>
        </ul>
    </nav>

</header>

<footer>
    <?php include 'Application/Views/' . $contentView;?>
</footer>

</body>
</html>