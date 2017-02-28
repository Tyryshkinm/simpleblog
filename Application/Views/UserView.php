<div class="user">
    <?php
    echo '<b>' . 'Username: ' . '</b>' . $data['username'] . '<br>';
    echo '<b>' . 'Email: ' . '</b>' . $data['email'] . '<br>';
    echo '<b>' . 'First name: ' . '</b>' . $data['firstName'] . '<br>';
    echo '<b>' . 'Second name: ' . '</b>' . $data['secondName'] . '<br>';
    echo '<b>' . 'Sex: ' . '</b>' . $data['sex'] . '<br>';
    ?>
    <div class="button">
        <?php if (!empty($_SESSION['loggedUser'])):?>
            <?php if ($_SESSION['userId'] == $data['id'] or $_SESSION['role'] == 1):?>
                <form method="post" action="/user/<?=$data['id']?>/edit">
                    <input type="submit" class="btn btn-primary" value="Edit user" />
                </form>
            <?php endif;?>
            <?php if ($_SESSION['role'] == 1):?>
                <form class="userButton" method="post" action="/user/<?=$data['id']?>/delete">
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
            <?php if ($_SESSION['role'] == 1 and $_SESSION['userId']!=$data['id'] and $data['role'] == 0):?>
                <form class="userButton" method="post" action="/user/<?=$data['id']?>/setAsAdmin">
                    <input type="submit" class="btn btn-primary" value="Set as Admin">
                </form>
            <?php endif;?>
        <?php endif;?>
    </div>
</div>