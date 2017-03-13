<?php if (isset($data) and is_array($data)):?>
    <?php foreach ($data as $post):?>
        <div class="post">
            <div class="titleAndLike">
                <div class="title">
                    <a class="h2" href="/post/<?=$post['id'];?>/view"><?=$post['title'];?></a><br>
                </div>
                <?php if (isset($_SESSION['loggedUser'])):?>
                    <div class="heart">
                        <?php if (in_array($post['id'], $_SESSION['likedPosts'])):?>
                            <button>
                                <span class="heartbutton red" id="<?php echo $post['id'];?>">❤</span>
                            </button>
                        <?php else:?>
                            <button>
                                <span class="heartbutton" id="<?php echo $post['id'];?>">❤</span>
                            </button>
                        <?php endif;?>
                        <div class="descr" hidden>
                            <div class="wholiked"></div>
                            <button>
                                <span class="viewmore" id="<?php echo $post['id'];?>">view more</span>
                            </button>
                        </div>
                    </div>
                <?php endif;?>
            </div>
            <div class="content">
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
        </div>
    <?php endforeach;?>
<?php endif;?>