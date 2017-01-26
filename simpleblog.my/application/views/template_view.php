<?php

echo "Это шаблон для всех страниц".'</br>';
echo "Меню".'</br>';

?>

<a href="/">Home</a>
<a href="/registration">Registration</a>
<a href="/login">Login</a></br>
<?php include 'application/views/'.$content_view;?>