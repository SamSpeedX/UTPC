<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require "config/app.php";
require "core/Database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        $sam = new Database();
        $pdo = $sam->connect();

        $questions = $_POST['questions'] ?? [];
        $inputTypes = $_POST['input_types'] ?? [];
        $optionsArray = $_POST['options'] ?? [];
        $token = uniqid();

        if (!empty($questions) && count($questions) === count($inputTypes)) {
            $pdo->beginTransaction();

            $stmt = $pdo->prepare("INSERT INTO questionnaires (question, input_type, options, token) VALUES (:question, :input_type, :options, :token)");
            for ($i = 0; $i < count($questions); $i++) {
                $stmt->execute([
                    ':question' => $questions[$i],
                    ':input_type' => $inputTypes[$i],
                    ':options' => $optionsArray[$i],
                    ':token' => $token,
                ]);
            }

            $pdo->commit();
            echo json_encode(["status" => "success", "message" => "Questionnaire saved successfully!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid data provided!"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
} else {
    echo  json_encode(['name' => 'sam']);
}
?>