<?php
Session::check();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="shortcut icon" href="assets/img/icon.jpeg" type="image/x-icon">
    <link rel="apple-touch-icon" href="assets/img/icon.jpeg">
    <link rel="icon" href="assets/img/icon.jpeg">
    <title><?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <header class="header">
        <div class="top1">
            <div class="logo"><img alt="" width="70rem" src="assets/img/logo.png"></div>
            <div class="app_name"><h1><?php echo APP_NAME; ?></h1></div>
        </div>
        <div class="top2">
            <nav>
                <ul>
                    <li><a href="/" class="current">home</a></li> |
                    <li><a href="profile">Dashboard</a></li>|
                    <li><a href="logout">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="main">
        <a href="apply">Apply now</a>
    </div>
    <footer>
        <div class="copy">
            <p><a href="https://www.reconnect.co.tz" target="_blank" rel="noopener noreferrer"><?php echo DEV; ?></a></p>
            <p><?php echo date('Y').'&copy;  ';  echo "UTPC"; ?></p>
        </div>
    </footer>
</body>
</html>