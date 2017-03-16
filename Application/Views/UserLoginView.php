<div class="login">
    <p>Login</p>
    <form method="post" action="/user/login">
        <input type="text" name="username" value="<?=$data['username'];?>" placeholder="username" /></br>
        <input type="password" name="password" placeholder="password" />
        <div class="button">
            <input type="submit" class="btn btn-primary" name="login" value="Login" />
        </div>
    </form>
    <a href="/user/resetPassEmail" >Forgot your password?</a>
</div>

<?php if ($msgError == 'Invalid username'):?>
    <script>
        $('.login > form:nth-child(2) > input:nth-child(1)').css('border', '1px solid red')
    </script>
<?php endif;?>

<?php if ($msgError == 'Invalid password'):?>
    <script>
        $('.login > form:nth-child(2) > input:nth-child(3)').css('border', '1px solid red')
    </script>
<?php endif;?>
