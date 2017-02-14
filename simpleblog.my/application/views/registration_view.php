<div class="registration">
    <p>Registration</p>
    <form method="post" action="/user/registration">
        <input type="text" name="username" placeholder="username" required /><br>
        <input type="text" name="first_name" placeholder="first name" required /><br>
        <input type="text" name="second_name" placeholder="second name" required /><br>
        <input type="password" name="password" placeholder="password" required /><br>
        <input type="password" name="repeat_password" placeholder="repeat password" required /><br>
        sex
        <select name="sex" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select><br><br>
        <input type="submit" class="btn btn-primary" name="register" value="Register" />
    </form>
</div>