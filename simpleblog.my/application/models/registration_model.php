<?php
require_once("connect_db.php");
class registration_model extends model
{
   /* public function add_user()
    {

            if (isset($_POST['register'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $first_name = $_POST['first_name'];
                $second_name = $_POST['second_name'];
                header('Location: /login');

            if ($password == $_POST['repeat_password'])
            {
                $query = "INSERT INTO users (username, password, first_name, second_name) VALUES (:username, :password, :first_name, :second_name)";
                $add_user_bd = $connect_bd->prepare($query);
                $add_user_bd->bindValue(':username', $username);
                $add_user_bd->bindValue(':password', $password);
                $add_user_bd->bindValue(':first_name', $first_name);
                $add_user_bd->bindValue(':second_name', $second_name);
                $result = $add_user_bd -> execute();
                header('location: view_login.html');
            }
            echo "Passwords do not match";
            header('Location: /');
        }
    }*/
}

?>
