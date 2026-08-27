<?php include 'header.php'; ?>

<section class="form-container">
    <h1>Register</h1>

    <form action="#" method="POST">

        <label>Full Name</label>
        <input type="text" name="fullname" placeholder="Enter Full Name" required>

        <label>Email</label>
        <input type="email" name="email" placeholder="Enter Email" required>

        <label>Username</label>
        <input type="text" name="username" placeholder="Enter Username" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Enter Password" required>

        <label>Confirm Password</label>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>

        <input type="submit" value="Register">

    </form>

    <p>Already have an account? <a href="login.php">Login here</a></p>
</section>

<?php include 'footer.php'; ?>