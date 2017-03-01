<div class="login">
    <p>Login</p>
    <form method="post" action="/user/login">
        <input type="text" name="username" placeholder="username" required /></br>
        <input type="password" name="password" placeholder="password" required />
        <div class="button">
            <input type="submit" class="btn btn-primary" name="login" value="Login" />
        </div>
    </form>
    <a href="/user/resetPassEmail" >Forgot your password?</a>
</div>