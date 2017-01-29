<?php

if (isset($_SESSION['logged_user'])): ?>
<?php echo "Привет, " . $_SESSION['logged_user'].", вы аторизованы!".'</br>';?>
<a href="/">Home</a>
<a href="/addpost">Add_post</a>
<a href="/login/logout_user">Logout</a></br>
<?php include 'application/views/'.$content_view;?>


<?php else: ?>
<?php echo "Вы не авторизованы!".'</br>' ?>
<a href="/">Home</a>
<a href="/registration">Registration</a>
<a href="/login">Login</a></br>
<?php include 'application/views/'.$content_view;?>

 <?php endif;?>