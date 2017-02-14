<div class="userEdit">
    <p>Edit user: <?=$data['username']?></p>
    <form method="post" action="/user/<?=$data['id']?>/edit">
        <input type="text" name="first_name" value="<?=$data['first_name']?>" placeholder="first name" /><br>
        <input type="text" name="second_name" value="<?=$data['second_name']?>" placeholder="second name" /><br>
        <input type="password" name="old_password" placeholder="old password" /><br>
        <input type="password" name="password" placeholder="password" /><br>
        <input type="password" name="repeat_password" placeholder="repeat password" /><br>
        sex
        <select name="sex" required>
            <?php if ($data['sex']=='male'):?>
                <option value="male" selected >Male</option>
                <option value="female">Female</option>
            <?php else: ?>
                <option value="male">Male</option>
                <option value="female" selected >Female</option>
            <?php endif;?>
        </select><br><br>
        <input type="submit" class="btn btn-primary" name="save" value="Save" />
    </form>
</div>