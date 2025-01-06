<?php
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

        // Save answers to the database (example table structure for responses)
        $stmt = $pdo->prepare("INSERT INTO responses (question_id, answer) VALUES (:question_id, :answer)");

        foreach ($answers as $questionId => $answer) {
            // Handle multiple answers for checkboxes
            if (is_array($answer)) {
                foreach ($answer as $subAnswer) {
                    $stmt->execute([
                        ':question_id' => $questionId,
                        ':answer' => $subAnswer,
                    ]);
                }
            } else {
                $stmt->execute([
                    ':question_id' => $questionId,
                    ':answer' => $answer,
                ]);
            }
        }

        echo "Thank you for your submission!";
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
