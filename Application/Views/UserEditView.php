<div class="userEdit">
    <p>Edit user: <?=$data['username']?></p>
    <form method="post" action="/user/<?=$data['id']?>/edit">
        <input type="email" name="email" value="<?=$data['email']?>" placeholder="email" /><br>
        <input type="text" name="firstName" value="<?=$data['firstName']?>" placeholder="first name" /><br>
        <input type="text" name="secondName" value="<?=$data['secondName']?>" placeholder="second name" /><br>
        <input type="password" name="oldPassword" placeholder="old password" /><br>
        <input type="password" name="password" placeholder="password" /><br>
        <input type="password" name="repeatPassword" placeholder="repeat password" /><br>
        <select name="sex" required>
            <?php if ($data['sex']=='male'):?>
                <option value="male" selected >Male</option>
                <option value="female">Female</option>
            <?php else: ?>
                <option value="male">Male</option>
                <option value="female" selected >Female</option>
            <?php endif;?>
        </select>
        <div class="button">
            <input type="submit" class="btn btn-primary" name="save" value="Save" />
        </div>
    </form>
</div>