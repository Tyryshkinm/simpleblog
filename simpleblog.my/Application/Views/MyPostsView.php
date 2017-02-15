<div class="postOutput">
    <?php if (isset($data) and is_array($data)):?>
        <?php foreach ($data as $post):?>
            <div class="post">
                <b>id: </b><?=$post['id'];?><br>
                <b>title: </b><a href="/user/myPosts/<?=$post['id'];?>/view"><?=$post['title'];?></a><br>
                <b>text: </b><?=mb_substr($post['text'], 0, 200, 'UTF-8');?>...<a href="/user/myPosts/<?=$post['id'];?>/view">read more</a><br>
                <b>date: </b><?=$post['date'];?><br>
                <b>author: </b><a href="/user/<?=$post['author'];?>"><?=$post['firstName'] . ' ' . $post['secondName'];?></a><br>
            </div>
        <?php endforeach;?>
    <?php endif;?>
</div>