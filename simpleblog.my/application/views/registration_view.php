<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
</head>
<body>

<form method="post" action="/registration/add_user">
    <input type="text" name="username" placeholder="username" required /><br>
    <input type="text" name="first_name" placeholder="first name" required /><br>
    <input type="text" name="second_name" placeholder="second name" required /><br>
    <input type="password" name="password" placeholder="password" required /><br>
    <input type="password" name="repeat_password" placeholder="repeat password" required /><br>
    sex
    <select name="sex" required>
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select><br><br>
    <input type="submit" name="register" value="Register" />

</form>

</body>
</html>