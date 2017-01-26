<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
</head>
<body>
<?php echo "Это страница регистрации нового пользователя".'<br>';?>
<form method="post" action="/registration">
    <input type="text" name="username" placeholder="username" required /></br>
    <input type="text" name="first_name" placeholder="first name" required /></br>
    <input type="text" name="second_name" placeholder="second name" required /></br>
    <input type="password" name="password" placeholder="password" required /></br>
    <input type="password" name="repeat_password" placeholder="repeat password" required /></br>
    <input type="submit" name="register" value="Register" />
</form>

</body>
</html>