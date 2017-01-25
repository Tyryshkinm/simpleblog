<?php

require_once("connect_db.php");

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT id, username, password FROM users WHERE username = :username";
    $user_login = $connect_bd -> prepare($query);
    $user_login -> bindValue(':username', $username);
    $user_login -> execute();
    $user = $user_login -> fetch(PDO::FETCH_ASSOC);
    if($user === false)
    {
        die ('Ivalid username or password');
    }
    else {
        if ($password == $user['password']) {
            header('Location: index.php');
        } else {
            die ('Invalid username or password');
        }
    }
}

?>