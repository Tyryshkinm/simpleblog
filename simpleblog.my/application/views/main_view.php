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

<a href="/page/1">first page</a>
<?php if ($current_page>5):?>
    <a href="/page/<?=$current_page-5?>"><?=$current_page-5?></a>
<?php endif;?>
<?php if ($current_page>4):?>
    <a href="/page/<?=$current_page-4?>"><?=$current_page-4?></a>
<?php endif;?>
<?php if ($current_page>3):?>
    <a href="/page/<?=$current_page-3?>"><?=$current_page-3?></a>
<?php endif;?>
<?php if ($current_page>2):?>
    <a href="/page/<?=$current_page-2?>"><?=$current_page-2?></a>
<?php endif;?>
<?php if ($current_page>1):?>
    <a href="/page/<?=$current_page-1?>"><?=$current_page-1?></a>
<?php endif;?>
...
<a href="/page/<?=$current_page?>"><?=$current_page?></a>
...
<?php if ($current_page+1<=$last_page):?>
    <a href="/page/<?=$current_page+1?>"><?=$current_page+1?></a>
<?php endif;?>
<?php if ($current_page+2<=$last_page):?>
    <a href="/page/<?=$current_page+2?>"><?=$current_page+2?></a>
<?php endif;?>
<?php if ($current_page+3<=$last_page):?>
    <a href="/page/<?=$current_page+3?>"><?=$current_page+3?></a>
<?php endif;?>
<?php if ($current_page+4<=$last_page):?>
    <a href="/page/<?=$current_page+4?>"><?=$current_page+4?></a>
<?php endif;?>
<?php if ($current_page+5<=$last_page):?>
    <a href="/page/<?=$current_page+5?>"><?=$current_page+5?></a>
<?php endif;?>
<a href="/page/<?=$last_page?>">last page</a>
