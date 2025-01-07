<?php 
Admin::fetch();
?>
<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/logo.jpeg" type="image/x-icon">
    <link rel="apple-touch-icon" href="assets/img/logo.jpeg">
    <link rel="icon" href="assets/img/logo.jpeg">
    <title>Update | <?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="assets/css/userform.css">
</head>
<body>

<div class="login-container">
    <h2>Update Your Account.</h2>
    <p>fill your credential bellow to make change.</p>
    <form action="change" method="POST">
        <input type="hidden" name="id" value="<?php echo $_SESSION['uid_boss']; ?>">
        
        <label for="password">password:</label>
        <input type="password" id="password"  name="password" required>

        <button type="submit" onclick="user_login()">save</button>
        <p><a href="dashboard">Go back</a></p>
    </form>
</div>
<script scr=""></script>
</body>
</html>
