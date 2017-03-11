<div class="postOutput">
    <?php if (isset($data) and is_array($data)):?>
        <?php foreach ($data as $post):?>
            <div class="post">
                <div class="title">
                    <a class="h2" href="/post/<?=$post['id'];?>/view"><?=$post['title'];?></a><br>
                </div>
                <div class="authorAndDate">
                    <div class="author">
                        <b>Author: </b><a href="/user/<?=$post['author'];?>">
                            <?=$post['firstName'] . ' ' . $post['secondName'];?></a><br>
                    </div>
                    <div class="date">
                        <b>Date: </b><?=$post['date'];?><br>
                    </div>
                </div>
                <?=mb_substr($post['text'], 0, 200, 'UTF-8');?>...<a href="/post/<?=$post['id'];?>/view">read more</a>
            </div>
        <?php endforeach;?>
    <?php endif;?>
</div>