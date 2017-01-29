<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>AddPost</title>
</head>
<body>
<?php echo "Это страница добавления поста".'<br>';?>
<form method="post" action="/addpost/add">
    <input type="text" name="post_title" placeholder="Title of Post" required /></br>
    <textarea name="post_text" cols="25" rows="10" placeholder="Text of Post" required ></textarea></br>
    <input type="submit" name="add" value="Add post" />
</form>

</body>
</html>