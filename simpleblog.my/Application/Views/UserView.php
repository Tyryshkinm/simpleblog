<div class="post">
    <?php
    echo '<b>' . 'id: ' . '</b>' . $data['id'] . '<br>';
    echo '<b>' . 'username: ' . '</b>' . $data['username'] . '<br>';
    echo '<b>' . 'first name: ' . '</b>' . $data['firstName'] . '<br>';
    echo '<b>' . 'second name: ' . '</b>' . $data['secondName'] . '<br>';
    echo '<b>' . 'sex: ' . '</b>' . $data['sex'] . '<br>';
    ?>
    <br>
    <?php if (!empty($_SESSION['loggedUser'])):?>
        <?php if ($_SESSION['userId'] == $data['id'] or $_SESSION['role'] == 1):?>
            <form method="post" action="/user/<?=$data['id']?>/edit">
                <input type="submit" class="btn btn-primary" value="Edit user" />
            </form>
        <?php endif;?>
        <br>
        <?php if ($_SESSION['role'] == 1):?>
            <form method="post" action="/user/<?=$data['id']?>/delete">
                <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target=".bs-example-modal-sm">Delete user</button>

                <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog"
                     aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <p>Delete user <?=$data['username']?>?</p>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php endif;?>
        <br>
        <?php if ($_SESSION['role'] == 1 and $_SESSION['userId']!=$data['id'] and $data['role'] == 0):?>
            <form method="post" action="/user/<?=$data['id']?>/setAsAdmin">
                <input type="submit" class="btn btn-primary" value="Set as Admin">
            </form>
        <?php endif;?>
    <?php endif;?>
</div>