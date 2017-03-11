<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>SimpleBlog</title>
    <link rel="stylesheet" href="../../Assets/css/styles.css" />
    <script
            src="https://code.jquery.com/jquery-3.1.1.js"
            integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
            crossorigin="anonymous">
    </script>
    <script src="../../Assets/js/likes.js"></script>
    <link rel="stylesheet" href="../../Assets/bootstrap-3.3.2-dist/css/bootstrap.css">
    <script src="../../Assets/bootstrap-3.3.2-dist/js/bootstrap.js" type="text/javascript"></script>
</head>
<body>

<header>
    <nav>
        <?php if (isset($_SESSION['loggedUser'])):?>
            <p><?php echo 'Hello, ' . '<a href="/user/'.$_SESSION['userId'] . '">' .  $_SESSION['loggedUser'] . '</a>' . ', you are logged!' . '</br>';?></p>
        <?php endif;?>
        <ul>
            <?php if (isset($_SESSION['loggedUser'])):?>
                <li><a href="/">Home</a></li>
                <li><a href="/user/<?=$_SESSION['userId'];?>/myPosts">My Posts</a></li>
                <li><a href="/post/add">Add Post</a></li>
                <li><a href="/user/logout">Logout</a></li>
                <li>
                    <div class="search">
                        <form name="search" method="post" action="/post/search">
                            <input type="search" name="search" placeholder="Search" required>
                            <button type="submit" class="btn-xs">Search</button>
                        </form>
                    </div>
                </li>
            <?php else:?>
                <li><a href="/">Home</a></li>
                <li><a href="/user/registration">Registration</a></li>
                <li><a href="/user/login">Login</a></li>
                <li>
                    <div class="search">
                        <form name="search" method="post" action="/post/search">
                            <input type="search" name="search" placeholder="Search" required>
                            <button type="submit" class="btn-xs">Search</button>
                        </form>
                    </div>
                </li>
            <?php endif;?>
        </ul>
    </nav>

</header>



<section class="error">
    <?php if (!empty($msgError)):?>
        <?=$msgError;?>
    <?php endif;?>
</section>

<footer>
    <?php include 'Application/Views/' . $contentView;?>
</footer>

</body>
</html>