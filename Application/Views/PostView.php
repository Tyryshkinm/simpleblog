<div class="post">
    <div class="h2"><?=$data['title']?></div>
    <div class="authorAndDate">
        <div class="author">
            <b>Author: </b><a href="/user/<?=$data['author'];?>">
                <?=$data['firstName'] . ' ' . $data['secondName'];?></a><br>
        </div>
        <div class="date">
            <b>Date: </b><?=$data['date'];?><br><br>
        </div>
    </div>
    <?=$data['text']?><br>
    <br>
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