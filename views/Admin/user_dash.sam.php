<?php
Admin::fetch();
$token = $_SESSION['uid_boss'];

$user = $action->readone($_SESSION['uid_boss']);
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
    <title>Dashboard | <?php echo APP_NAME; ?></title>
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
            <li><a href="addquestion">Create Questions</a></li><br>
            <li><a href="application">My Application</a></li><br>
            <li><a href="userapplication">user application</a></li>
            <li><a href='/updateboss'>Update Account</a></li><br>
            <li><a href="/resetpassword">Update password</a></li><br>
            <li><?php echo " <a href='/fukuzaboss?token={$token}'>Delete Account</a>"?></li><br>
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
<!-- <style>
        * {
    padding: 0;
    margin: 0;
        box-sizing: border-box;
    }
    
    body {
        background-color: #fff;
    }
    
    .body {
        background-color: rgb(80, 80, 255);
    }
    
    .header {
        color: #ffffff;
        width: 100%;
        height: 10rem;
        top: 0;
        background-color: rgb(80, 80, 255);
        border-bottom: 2px solid yellow;
    }
    
    .main {
        height: 60vh;
    }
    
    .top1 {
        width: 100%;
        place-items: center;
        justify-content: center;
        padding: 0.8rem;
    }
    
    .top2 {
        text-align: center;
        padding: 0.2rem;
    }
    
    nav ul li {
        display: inline-block;
    }
    
    nav ul li a {
        padding: 0.5rem;
        color: #fff;
        text-decoration: none;
    }
    
    nav ul li a:hover {
        padding: 0.5rem;
        color: #94c1f5;
        text-decoration: none;
    }
    
    .current {
        color: rgb(47, 2, 73);
    }
    
    /* Side bar */
    .dashboard-container {
        display: flex;
        width: 100%;
        position: relative;
        place-items: center;
    }
    
    /* Side Navigation (Sidebar) */
    .sidebar {
        position: relative;
        width: 15rem;
        height: 100%;
        background-color: rgb(80, 80, 255);
        color: #fff;
        padding: 1rem;
        padding-top: 1rem;
    }
    
    .sidebar h2 {
        font-size: 20px;
        margin-bottom: 1.5rem;
    }
    
    .sidebar ul {
        list-style: none;
        padding: 0;
    }
    
    .sidebar ul li {
        margin-bottom: 1rem;
    }
    
    .sidebar ul li a {
        color: #fff;
        text-decoration: none;
        font-size: 16px;
        display: flex;
        align-items: center;
        padding: 0.5rem;
        border-radius: 5px;
        transition: background 0.3s ease;
    }
    
    .sidebar ul li a i {
        margin-right: 10px;
    }
    
    .sidebar ul li a:hover {
        background-color: #555;
    }
    
    /* Main Content */
    .main-content {
        flex-grow: 1;
        padding: 2rem;
        position: relative;
    }
    
    header h1 {
        color: #ffffff;
        font-size: 24px;
        margin-bottom: 0.5rem;
    }
    
    header p {
        color: #b9b1b1;
    }
    
    /* Cards Section */
    .overview {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }
    
    .card {
        color: #fff;
        flex: 1;
        padding: 1.5rem;
        background-color: #aba2f8;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .card h3 {
        font-size: 18px;
        color: #cac8c8;
    }
    
    .card p {
        color: #fffcfc;
    }
    
    footer {
        border-radius: 0;
        border-top-left-radius: 0.8rem;
        border-top-right-radius: 0.8rem;
        width: 100%;
        padding: 1rem;
        text-align: center;
        color: #fff;
        background-color: rgb(80, 80, 255);
        border-top: 2px solid yellow;
    }
    
    .copy {
        padding: 0.8rem;
    }
    
    .copy p {
        padding: 0.8rem;
    }
    
    .copy p a {
        color: #fff;
        text-decoration: none;
    }
    
    /* Table */
    table {
        width: 90%;
        border-collapse: collapse;
    }
    
    .t-c {
        display: flex;
        width: 100%;
        justify-content: center;
    }
    
    .t-c table td {
        flex-wrap: wrap;
    }
    
    .t-c table button {
        width: 6rem;
        height: 2rem;
        border: none;
    }
    
    .t-c table .pv:hover {
        border: none;
        color: white;
        background-color: green;
    }
    
    .t-c table .delete:hover {
        border: none;
        color: black;
        background-color: yellow;
    }
    
    .t-c table input {
        width: 80%;
        height: 2rem;
    }
    
    th {
        color: white;
        background-color: green;
    }
    
    td {
        background-color: lightblue;
    }
    
    th, td {
        padding: 1rem;
        border: 2px solid blue;
    }
    
    /* Mobile Media Queries */
    @media only screen and (max-width: 768px) {
        .header {
            height: 15rem;
            background-color: rgb(80, 80, 255);
            border-bottom: 2px solid yellow;
        }
    
        footer {
            border-bottom: 2px solid yellow;
        }
    
        .dashboard-container {
            display: block;
            width: 100%;
        }
    
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
            padding-top: 1rem;
            margin-top: 2rem;
        }
    
        .sidebar h2 {
            font-size: 18px;
            margin-bottom: 1rem;
        }
    
        .sidebar ul li {
            font-size: 14px;
        }
    
        .main-content {
            padding: 1rem;
        }
    
        .overview {
            display: block;
            margin-top: 1rem;
        }
    
        .card {
            margin-bottom: 1rem;
            padding: 1rem;
        }
    
        table {
            width: 100%;
        }
    
        .t-c table input {
            width: 100%;
            height: 2rem;
        }
    }
    
    /* Very small screens (Phones) */
    @media only screen and (max-width: 425px) {
        .header {
            height: 12rem;
        }
    
        footer {
            padding: 0.8rem;
        }
    
        .dashboard-container {
            display: block;
            width: 100%;
            margin-top: 1rem;
        }
    
        .sidebar {
            width: 100%;
            padding: 1rem;
        }
    
        .sidebar ul li {
            font-size: 14px;
            padding: 1rem 0;
        }
    
        .main-content {
            padding: 1rem;
        }
    
        .overview {
            display: block;
            margin-top: 1rem;
        }
    
        .card {
            margin-bottom: 1rem;
            padding: 1rem;
        }
    
        table {
            width: 100%;
            padding: 0.5rem;
        }
    
        .t-c table input {
            width: 100%;
            height: 2rem;
        }
    
        .copy p {
            font-size: 0.9rem;
        }
    }
    
</style> -->
</body>
</html>