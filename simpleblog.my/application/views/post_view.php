<br>
<b>id: </b><?=$data['id']?><br>
<b>titile: </b><?=$data['title']?><br>
<b>text: </b><?=$data['text']?><br>
<b>date: </b><?=$data['date']?><br>
<b>author: </b><a href="/user/<?=$data['author']?>"><?=$data['first_name'].' '.$data['second_name']?></a><br>
<br>
<?php if (!empty($_SESSION['logged_user'])):?>
    <?php if ($_SESSION['user_id'] == $data['author'] or $_SESSION['role'] == 1):?>
        <form method="post" action="/post/<?=$data['id']?>/edit">
            <input type="submit" value="Edit post" />
        </form>
        <form method="post" action="/post/<?=$data['id']?>/delete">
            <input type="submit" value="Delete post"?>
        </form>
    <?php endif;?>
<?php endif;?>