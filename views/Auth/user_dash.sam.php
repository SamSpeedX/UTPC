<?php
Session::check();
$token = $_SESSION['token'];

$user = $action->readone($_SESSION['token']);
?>
<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/icon.jpeg" type="image/x-icon">
    <link rel="apple-touch-icon" href="assets/img/icon.jpeg">
    <link rel="icon" href="assets/img/icon.jpeg">
    <link rel="stylesheet" href="assets/css/app.css">
    <title>Profile | <?php echo APP_NAME; ?></title>
    <!-- <link rel="stylesheet" href="../assets/css/userform.css"> -->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<body>
    <header class="header">
        <div class="top1">
            <div class="logo"><img alt="" width="70rem" src="assets/img/logo.png"></div>
            <div class="app_name"><h1><?php echo APP_NAME; ?></h1></div>
        </div>
    </header>

<div class="dashboard-container sp">
    <!-- Side Navigation -->
    <nav class="sidebar">
        <!-- <h2>Dashboard</h2> -->
        <ul>
            <li><a href="/home">home</a></li>
            <br>
            <li><a href="apply">Apply</a></li><br>
            <li><a href="myapplication">My Application</a></li><br>
            <li><a href='/updateuser'>Update Account</a></li><br>
            <li><a href="/updatepassword">Update password</a></li><br>
            <li><?php echo " <a href='/deleteuser?token={$token}'>Delete Account</a>"?></li><br>
            <li><a href="/logout">Logout</a></li>
        </ul>
    </nav>
    <!-- Main Content -->
    <div class="main-content">
        <div class="pp1">
            <h1>Welcome, <?php echo $user['username']; ?><span id="user-name"></span></h1>
            <p>Here is your profile you can change your data.</p>
        </div>

        <section class="overview">
            <div class="card">
                <h3></h3>
                <p> <?php echo $user['username']; ?></p>
                <p> <?php echo $user['email']; ?></p>
            </div>
        </section>
    </div>
</div>
    <footer>
        <div class="copy">
            <p><a href="https://www.reconnect.co.tz" target="_blank" rel="noopener noreferrer"><?php echo DEV; ?></a></p>
            <p><?php echo date('Y').'&copy;  ';  echo "UTPC"; ?></p>
        </div>
    </footer>
</body>
</html>
