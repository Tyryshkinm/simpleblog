<?php if (isset($data) and is_array($data)):?>
    <?php foreach ($data as $post):?>
        <div class="post">
            <div class="titleAndLike">
                <div class="title" id="title<?php echo $post['id'];?>">
                    <a class="h2" href="/post/<?=$post['id'];?>/view"><?=$post['title'];?></a><br>
                </div>
                <div class="heart">
                    <?php if (isset($_SESSION['likedPosts']) and (in_array($post['id'], $_SESSION['likedPosts']))):?>
                        <button>
                            <span class="heartbutton red" id="<?php echo $post['id'];?>">❤</span>
                        </button>
                    <?php elseif ((!isset($_SESSION['loggedUser']) and (in_array($post['id'], $likedPosts)))
                        or (isset($_SESSION['loggedUser']))):?>
                        <button>
                            <span class="heartbutton" id="<?php echo $post['id'];?>">❤</span>
                        </button>
                    <?php endif;?>
                    <div class="descr">
                        <div class="wholiked"></div>
                        <button id="<?php echo $post['id'];?>">
                            <span class="viewmore" id="<?php echo $post['id'];?>">view more</span>
                        </button>
                    </div>
                </div>
                <div class="pencil">
                    <?php if (((isset ($_SESSION['userId'])) and ($_SESSION['userId']) == $post['author'])
                        or ((isset($_SESSION['role'])) and ($_SESSION['role'] == 1))):?>
                        <button>
                            <span class="pencilbutton" id="<?php echo $post['id'];?>">&#9998;</span>
                        </button>
                    <?php endif;?>
                </div>
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
                <div class="text" id="text<?php echo $post['id'];?>">
                    <?=mb_substr($post['text'], 0, 200, 'UTF-8');?>...<a href="/post/<?=$post['id'];?>/view">read more</a>
                </div>
            </div>
        </div>
        <div hidden class="editPostAjax" id="edit<?php echo $post['id'];?>"></div>
    <?php endforeach;?>
<?php endif;?>