<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// require "config/app.php";
// require "core/Database.php";

try {
    $sam = new Database();
    $pdo = $sam->connect();

    // Fetch all questionnaire data
    $stmt = $pdo->query("SELECT * FROM questionnaires");
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/icon.jpeg" type="image/x-icon">
    <link rel="apple-touch-icon" href="assets/img/icon.jpeg">
    <link rel="icon" href="assets/img/icon.jpeg">
    <title>application | <?php echo APP_NAME; ?></title>
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
    <!-- <link rel="stylesheet" href="assets/css/all.min.css"> -->
    <link rel="stylesheet" href="assets/css/userform.css">
    <!-- <link rel="stylesheet" href="assets/css/app.css"> -->

    <style>
        /* body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }
        .question {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        } */
    </style>
</head>
<body>

<div class="login-container">
    <header>
        <div class="logo"><img src="assets/img/logo.png" width="70rem" alt="logo"></div>
        <div class="app_name"><?php echo APP_NAME; ?></div>
    </header>
<!-- <div class="psc"></div> -->
    <h1>Personal Training Questionnaire</h1>
    <form action="submit_questionnaire.php" method="POST">
        <?php foreach ($questions as $index => $question): ?>
            <div class="question">
                <label for="q<?= $index; ?>"><?= htmlspecialchars($question['question']); ?></label>
                <?php
                $inputType = $question['input_type'];
                $options = !empty($question['options']) ? explode(',', $question['options']) : [];

                switch ($inputType) {
                    case 'text':
                        echo '<input type="text" name="answers[]" id="q' . $index . '" placeholder="'.$question['question'].'" required>';
                        break;
                    case 'tel':
                        echo '<input type="tel" name="answers[]" id="q' . $index . '" placeholder="'.$question['question'].'" required>';
                        break;
                    case 'number':
                        echo '<input type="number" name="answers[]" id="q' . $index . '" placeholder="'.$question['question'].'" required>';
                        break;
                    case 'textarea':
                        echo '<textarea name="answers[]" id="q' . $index . '" placeholder="'.$question['question'].'" required></textarea>';
                        break;
                    case 'radio':
                    case 'checkbox':
                        foreach ($options as $option) {
                            echo '<div>';
                            echo '<input type="' . $inputType . '" name="answers[q' . $index . '][]" value="' . htmlspecialchars(trim($option)) . '">';
                            echo htmlspecialchars(trim($option));
                            echo '</div>';
                        }
                        break;
                    case 'dropdown':
                        echo '<select name="answers[]" id="q' . $index . '" required>';
                        foreach ($options as $option) {
                            echo '<option value="' . htmlspecialchars(trim($option)) . '">' . htmlspecialchars(trim($option)) . '</option>';
                        }
                        echo '</select>';
                        break;
                    default:
                        echo '<input type="text" name="answers[]" id="q' . $index . '" required>';
                        break;
                }
                ?>
            </div>
        <?php endforeach; ?>

        <button type="submit">Submit</button>
    </form>
</div>
</body>
</html>