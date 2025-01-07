<?php 
//
?>
<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/icon.jpeg" type="image/x-icon">
    <link rel="apple-touch-icon" href="assets/img/icon.jpeg">
    <link rel="icon" href="assets/img/icon.jpeg">
    <title>Login | <?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="assets/css/userform.css">
</head>
<body class="body">

<div class="login-container">
    <h2>Login to Your Account.</h2>
    <p>fill your credential bellow to login.</p>
    <form action="log_in" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <div class="limks-f">
            <p><a href="resetpass">Forgot password</a></p>
        </div>

        <button type="submit" onclick="user_login()">Login</button>
        <p>You dont't have account? <a href="register">Register</a>.</p>
    </form>
    <p><a href="in">Login as Admin.</a></p>
</div>
<script>
    const inp = document.getElementById("check");
    inp.onclick = () => {
        if (inp == 'check') {
            alert("on")
        } else {
            alert("else")
        }
    }
</script>
<script scr="assets/js/form.js"></script>
</body>
</html>
