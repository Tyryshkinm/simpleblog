<div class="registration">
    <p>Registration</p>
    <form method="post" action="/user/registration">
        <input type="text" name="username" value="<?=$data['username'];?>" placeholder="username"/><br>
        <input type="email" name="email" value="<?=$data['email'];?>" placeholder="email" /><br>
        <input type="text" name="firstName" value="<?=$data['firstName'];?>" placeholder="first name" /><br>
        <input type="text" name="secondName"  value="<?=$data['secondName'];?>" placeholder="second name" /><br>
        <input type="password" name="password" placeholder="password" /><br>
        <input type="password" name="repeatPassword" placeholder="repeat password" /><br>
        <select name="sex">
            <?php if (isset($data) and $data['sex'] == 'male'):?>
            <option value="male" selected>Male</option>
            <?php elseif (isset($data) and $data['sex'] == 'female'):?>
            <option value="female" selected>Female</option>
            <?php endif;?>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
        <div class="button">
            <input type="submit" class="btn btn-primary" name="register" value="Register" />
        </div>
    </form>
</div>


<?php if (($msgError == 'Username is empty!') or ($msgError == 'A person with this username already exists')):?>
    <script>
        $('.registration > form:nth-child(2) > input:nth-child(1)').css('border', '1px solid red')
    </script>
<?php endif;?>

<?php if (($msgError == 'Email is empty!') or ($msgError == 'A person with this email already exists')):?>
    <script>
        $('.registration > form:nth-child(2) > input:nth-child(3)').css('border', '1px solid red')
    </script>
<?php endif;?>

<?php if ($msgError == 'First name is empty!'):?>
    <script>
        $('.registration > form:nth-child(2) > input:nth-child(5)').css('border', '1px solid red')
    </script>
<?php endif;?>

<?php if ($msgError == 'Second name is empty!'):?>
    <script>
        $('.registration > form:nth-child(2) > input:nth-child(7)').css('border', '1px solid red')
    </script>
<?php endif;?>

<?php if ($msgError == 'Password is empty!'):?>
    <script>
        $('.registration > form:nth-child(2) > input:nth-child(9)').css('border', '1px solid red')
    </script>
<?php endif;?>

<?php if ($msgError == 'Passwords do not match!'):?>
    <script>
        $('.registration > form:nth-child(2) > input:nth-child(9), .registration > form:nth-child(2) > input:nth-child(11)')
            .css('border', '1px solid red')
    </script>
<?php endif;?>
