<?php
//
?>
<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/logo.jpeg" type="image/x-icon">
    <link rel="apple-touch-icon" href="assets/img/logo.jpeg">
    <link rel="icon" href="assets/img/logo.jpeg">
    <title>Register | <?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="../assets/css/userform.css">
</head>
<body>

<div class="register-container">
    <h2>Create Account</h2>
    <p>Please your credential to register your acconut.</p>
    <form action="sajili" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" onclick="user_register()">Register</button>
        <p>You have Account? <a href="login">Login</a>.</p>
    </form>
</div>
<script src="../application/users.js"></script>
</body>
</html>

