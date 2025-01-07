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
    <link rel="stylesheet" href="assets/css/app.css">
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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f9fc;
            color: #333;
            overflow-x: hidden;
        }

        /* Loading Animation */
        #loading {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 9999;
            animation: fadeIn 1.5s ease-in-out;
        }

        /* Spinner styles */
        .spinner {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
        }

        /* Page Content */
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
            opacity: 0; /* Initially hidden */
            animation: fadeIn 1.5s ease-in-out 1.5s forwards;
        }

        h1 {
            color: #2c3e50;
            font-size: 2.5rem;
            animation: slideInFromTop 1s ease-out;
        }

        p {
            font-size: 1.2rem;
            line-height: 1.6;
            margin: 20px 0;
            animation: fadeIn 2s ease-in-out;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background-color: #3498db;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            animation: bounceIn 2s ease-in-out;
        }

        .btn:hover {
            background-color: #2980b9;
            transform: scale(1.1);
        }

        /* Keyframe Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideInFromTop {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes bounceIn {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.7;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Spinner Animation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

    </style>

    <!-- Loading Animation -->
    <div id="loading">
        <div class="spinner"></div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <h1>Welcome to UTPC Personal Training!</h1>
        <p>
            Thank you for choosing UTPC for your personal training needs. 
            We are committed to helping you achieve your fitness goals through personalized training programs.
        </p>
        <p>
            Please take a moment to complete our consultation questionnaire. Your answers will help us tailor a training plan that suits your specific needs and preferences.
        </p>
        <a href="/questionnaire" class="btn">Start Questionnaire</a>
    </div>

    <script>
        // JavaScript to hide the loading screen after the page is fully loaded
        window.onload = function() {
            // Hide the loading animation once everything is loaded
            document.getElementById("loading").style.display = "none";
        };
    </script>

    <footer>
        <div class="copy">
            <p><a href="https://www.reconnect.co.tz" target="_blank" rel="noopener noreferrer"><?php echo DEV; ?></a></p>
            <p><?php echo date('Y').'&copy;  ';  echo "UTPC"; ?></p>
        </div>
    </footer>
</body>
</html>



    <!-- <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f9fc;
            color: #333;
            overflow-x: hidden;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
            animation: fadeIn 1.5s ease-in-out;
        }
        h1 {
            color: #2c3e50;
            font-size: 2.5rem;
            animation: slideInFromTop 1s ease-out;
        }
        p {
            font-size: 1.2rem;
            line-height: 1.6;
            margin: 20px 0;
            animation: fadeIn 2s ease-in-out;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background-color: #3498db;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            animation: bounceIn 2s ease-in-out;
        }
        .btn:hover {
            background-color: #2980b9;
            transform: scale(1.1);
        }

        /* Keyframe Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        @keyframes slideInFromTop {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        @keyframes bounceIn {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.7;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style> -->

