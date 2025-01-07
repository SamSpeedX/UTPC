<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require "config/app.php";
require "core/Database.php";

try {
    $sam = new Database();
    $pdo = $sam->connect();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $answers = $_POST['answers'];

        $sql = "
        CREATE TABLE IF NOT EXISTS responses (
            id INT AUTO_INCREMENT PRIMARY KEY,
            uid VARCHAR(255) NOT NULL,
            question_id INT NOT NULL,
            answer TEXT NOT NULL,
            token VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $sql = "CREATE TABLE IF NOT EXISTS `responses` (`id` INT NOT NULL AUTO_INCREMENT , `uid` INT(100) NOT NULL , `question_id` INT(100) NOT NULL , `answer` VARCHAR(500) NOT NULL , `token` VARCHAR(100) NOT NULL , `created_at` INT(6) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // Save answers to the database (example table structure for responses)
        $stmt = $pdo->prepare("INSERT INTO responses (uid, question_id, answer) VALUES (:uid, :question_id, :answer)");

        foreach ($answers as $questionId => $answer) {
            // Handle multiple answers for checkboxes
            if (is_array($answer)) {
                foreach ($answer as $subAnswer) {
                    $stmt->execute([
                        ':question_id' => $questionId,
                        ':answer' => $subAnswer,
                        ':uid' => $_SESSION['token']
                    ]);
                }
            } else {
                $stmt->execute([
                    ':question_id' => $questionId,
                    ':answer' => $answer,
                    ':uid' => $_SESSION['token']
                ]);
            }
        }

        echo "Thank you for your submission!";
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
