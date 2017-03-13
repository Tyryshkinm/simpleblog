<div class="post">
    <div class="titleAndLike">
        <div class="title">
            <a class="h2" href="/post/<?=$data['id'];?>/view"><?=$data['title'];?></a><br>
        </div>
        <?php if (isset($_SESSION['loggedUser'])):?>
            <div class="heart">
                <?php if (in_array($data['id'], $_SESSION['likedPosts'])):?>
                    <button>
                        <span class="heartbutton red" id="<?php echo $data['id'];?>">❤</span>
                    </button>
                <?php else:?>
                    <button>
                        <span class="heartbutton" id="<?php echo $data['id'];?>">❤</span>
                    </button>
                <?php endif;?>
                <div class="descr" hidden>
                    <div class="wholiked"></div>
                    <button>
                        <span class="viewmore" id="<?php echo $data['id'];?>">view more</span>
                    </button>
                </div>
            </div>
        <?php endif;?>
    </div>
    <div class="content">
        <div class="authorAndDate">
            <div class="author">
                <b>Author: </b><a href="/user/<?=$data['author'];?>">
                    <?=$data['firstName'] . ' ' . $data['secondName'];?></a><br>
            </div>
            <div class="date">
                <b>Date: </b><?=$data['date'];?><br>
            </div>
        </div>
        <?=$data['text']?>
    </div>
    <div class="button">
        <?php if (!empty($_SESSION['loggedUser'])):?>
            <?php if ($_SESSION['userId'] == $data['author'] or $_SESSION['role'] == 1):?>
                <form method="post" action="/post/<?=$data['id']?>/edit">
                    <input type="submit" class="btn btn-primary" value="Edit post" />
                </form>
                <br>
                <form class="userButton" method="post" action="/post/<?=$data['id']?>/delete">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Delete post</button>
                    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <p>Delete post <?=$data['title']?>?</p>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php endif;?>
        <?php endif;?>
    </div>
</div>