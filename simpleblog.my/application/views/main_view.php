<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main</title>
</head>
<body>

<br>
<form method="post" action="/">
    <input type="submit" name="page" value="1">
    <?php if ($current_page>=6):?>
        <input type="submit" name="page" value="<?=$current_page-5;?>">
    <?endif;?>
    <?php if ($current_page>=5):?>
        <input type="submit" name="page" value="<?=$current_page-4;?>">
    <?endif;?>
    <?php if ($current_page>=4):?>
        <input type="submit" name="page" value="<?=$current_page-3;?>">
    <?endif;?>
    <?php if ($current_page>=3):?>
        <input type="submit" name="page" value="<?=$current_page-2;?>">
    <?endif;?>
    <?php if ($current_page>=2):?>
        <input type="submit" name="page" value="<?=$current_page-1;?>">
    <?endif;?>
    ...
    <input type="submit" name="page" value="<?=$current_page;?>">
    ...
    <?php if ($current_page+1 <= $last_page):?>
        <input type="submit" name="page" value="<?=$current_page+1;?>">
    <?php endif;?>
    <?php if ($current_page+2 <= $last_page):?>
        <input type="submit" name="page" value="<?=$current_page+2;?>">
    <?php endif;?>
    <?php if ($current_page+3 <= $last_page):?>
        <input type="submit" name="page" value="<?=$current_page+3;?>">
    <?php endif;?>
    <?php if ($current_page+4 <= $last_page):?>
        <input type="submit" name="page" value="<?=$current_page+4;?>">
    <?php endif;?>
    <?php if ($current_page+5 <= $last_page):?>
        <input type="submit" name="page" value="<?=$current_page+5;?>">
    <?php endif;?>
    <input type="submit" name="page" value="<?=$last_page?>">
</form>

<?php if (isset($data) and is_array($data)):?>
    <?php foreach ($data as $post):?>
        <br>
        <b>id: </b><?=$post['id']?><br>
        <b>titile: </b><a href="/post/<?=$post['id']?>"><?=$post['title']?></a><br>
        <b>text: </b><?=mb_substr($post['text'], 0, 200, 'UTF-8')?>...<a href="/post/<?=$post['id']?>">read more</a><br>
        <b>date: </b><?=$post['date']?><br>
        <b>author: </b><a href="/user/<?=$post['author']?>"><?=$post['first_name'].' '.$post['second_name']?></a><br>
    <?php endforeach;?>
<?php endif;?>

</body>
</html>

