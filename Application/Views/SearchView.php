<div class="search">
    <form name="search" method="post" action="/post/search">
        <input type="search" name="search" placeholder="Search" required>
        <button type="submit" class="btn-xs">Search</button>
    </form>
</div>

<div class="postOutput">
    <?php if (isset($data) and is_array($data)):?>
        <?php foreach ($data as $post):?>
            <div class="post">
                <b>title: </b><a href="/post/<?=$post['id'];?>/view"><?=$post['title'];?></a><br>
            </div>
        <?php endforeach;?>
    <?php endif;?>
</div>