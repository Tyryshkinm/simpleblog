<?php if (isset($data) and is_array($data)):?>
    <?php foreach ($data as $post):?>
        <br>
        <b>id: </b><?=$post['id'];?><br>
        <b>titile: </b><a href="/post/<?=$post['id'];?>"><?=$post['title'];?></a><br>
        <b>text: </b><?=mb_substr($post['text'], 0, 200, 'UTF-8');?>...<a href="/post/<?=$post['id'];?>">read more</a><br>
        <b>date: </b><?=$post['date'];?><br>
        <b>author: </b><a href="/user/<?=$post['author'];?>"><?=$post['first_name'].' '.$post['second_name'];?></a><br>
    <?php endforeach;?>
<?php endif;?>

<br>
<form method="post" action="/">
    <button formmethod="post" formaction="/" value="1" name="page">first page</button>
    <?php if ($current_page>5):?>
        <button formmethod="post" formaction="/" value="<?=$current_page-5;?>" name="page"><?=$current_page-5;?></button>
    <?php endif;?>
    <?php if ($current_page>4):?>
        <button formmethod="post" formaction="/" value="<?=$current_page-4;?>" name="page"><?=$current_page-4;?></button>
    <?php endif;?>
    <?php if ($current_page>3):?>
        <button formmethod="post" formaction="/" value="<?=$current_page-3;?>" name="page"><?=$current_page-3;?></button>
    <?php endif;?>
    <?php if ($current_page>2):?>
        <button formmethod="post" formaction="/" value="<?=$current_page-2;?>" name="page"><?=$current_page-2;?></button>
    <?php endif;?>
    <?php if ($current_page>1):?>
        <button formmethod="post" formaction="/" value="<?=$current_page-1;?>" name="page"><?=$current_page-1;?></button>
    <?php endif;?>
    ...
    <button formmethod="post" formaction="/" value="<?=$current_page;?>" name="page"><?=$current_page;?></button>
    ...
    <?php if ($current_page+1 <= $last_page):?>
        <button formmethod="post" formaction="/" value="<?=$current_page+1;?>" name="page"><?=$current_page+1;?></button>
    <?php endif;?>
    <?php if ($current_page+2 <= $last_page):?>
        <button formmethod="post" formaction="/" value="<?=$current_page+2;?>" name="page"><?=$current_page+2;?></button>
    <?php endif;?>
    <?php if ($current_page+3 <= $last_page):?>
        <button formmethod="post" formaction="/" value="<?=$current_page+3;?>" name="page"><?=$current_page+3;?></button>
    <?php endif;?>
    <?php if ($current_page+4 <= $last_page):?>
        <button formmethod="post" formaction="/" value="<?=$current_page+4;?>" name="page"><?=$current_page+4;?></button>
    <?php endif;?>
    <?php if ($current_page+5 <= $last_page):?>
        <button formmethod="post" formaction="/" value="<?=$current_page+5;?>" name="page"><?=$current_page+5;?></button>
    <?php endif;?>
    <button formmethod="post" formaction="/" value="<?=$last_page;?>" name="page">last page</button>

</form>