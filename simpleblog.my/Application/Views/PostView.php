<div class="post">
    <b>id: </b><?=$data['id']?><br>
    <b>title: </b><?=$data['title']?><br>
    <b>text: </b><?=$data['text']?><br>
    <b>date: </b><?=$data['date']?><br>
    <b>author: </b><a href="/user/<?=$data['author']?>"><?=$data['firstName'] . ' ' . $data['secondName']?></a><br>
    <br>
    <?php if (!empty($_SESSION['loggedUser'])):?>
        <?php if ($_SESSION['userId'] == $data['author'] or $_SESSION['role'] == 1):?>
            <form method="post" action="/post/<?=$data['id']?>/edit">
                <input type="submit" class="btn btn-primary" value="Edit post" />
            </form>
            <br>
            <form method="post" action="/post/<?=$data['id']?>/delete">
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
