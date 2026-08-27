<?php include 'layout/header.php'; ?>

<section class="form-container">
    <h1>Forgot Password</h1>

    <p>Enter your email address to reset your password.</p>

    <form action="#" method="POST">

        <label>Email</label>
        <input type="email" name="email" placeholder="Enter Your Email" required>

        <input type="submit" value="Reset Password">

    </form>

    <p>
        <a href="login.php">Back to Login</a>
    </p>
</section>

<?php include 'layout/footer.php'; ?>