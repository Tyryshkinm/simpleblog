<div class="registration">
    <p>Registration</p>
    <form method="post" action="/user/registration">
        <input type="text" name="username" placeholder="username" required /><br>
        <input type="email" name="email" placeholder="email" required /><br>
        <input type="text" name="firstName" placeholder="first name" required /><br>
        <input type="text" name="secondName" placeholder="second name" required /><br>
        <input type="password" name="password" placeholder="password" required /><br>
        <input type="password" name="repeatPassword" placeholder="repeat password" required /><br>
        <select name="sex" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
        <div class="button">
            <input type="submit" class="btn btn-primary" name="register" value="Register" />
        </div>
    </form>
</div>