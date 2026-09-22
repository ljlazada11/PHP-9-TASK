<?php include 'layout/header.php'; ?>

<section class="form-container">
    <h1>Login</h1>

    <form action="#" method="POST">

        <label>Username</label>
        <input type="text" name="username" placeholder="Enter Username" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Enter Password" required>

        <input type="submit" value="Login">

    </form>

    <p>
        <a href="forgot_password.php">Forgot Password?</a>
    </p>

    <p>
        Don't have an account?
        <a href="register.php">Register here</a>
    </p>
</section>

<?php include 'layout/footer.php'; ?>