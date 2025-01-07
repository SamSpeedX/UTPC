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

        // $dd = file_get_contents('php://input');
        $h = $_POST['headings'] ?? [];
        $questions = $_POST['questions'] ?? [];
        $inputTypes = $_POST['input_types'] ?? [];
        $optionsArray = $_POST['options'] ?? [];
        $token = bin2hex(random_bytes(3)).uniqid();

        if (!empty($questions) && count($questions) === count($inputTypes)) {
            $pdo->beginTransaction();

            $sql = "
            CREATE TABLE IF NOT EXISTS questionnaires (
                id INT AUTO_INCREMENT PRIMARY KEY,
                header VARCHAR(255) NOT NULL,
                question TEXT NOT NULL,
                input_type VARCHAR(50) NOT NULL,
                options TEXT,
                token VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
            ";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $stmt = $pdo->prepare("INSERT INTO questionnaires (header, question, input_type, options, token) VALUES (:h, :question, :input_type, :options, :token)");
            for ($i = 0; $i < count($questions); $i++) {
                $stmt->execute([
                    ':h' => $h,
                    ':question' => $questions[$i],
                    ':input_type' => $inputTypes[$i],
                    ':options' => $optionsArray[$i],
                    ':token' => $token,
                ]);
            }

            $pdo->commit();
            echo json_encode(["status" => "success", "message" => "Questionnaire saved successfully!", "link" => "https://questionnaier.utpc.or.tz/apply?token={$token}"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid data provided!"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
} 
?>
<?php
// ini_set('display_errors', 0); // Suppress HTML errors in production
// ini_set('log_errors', 1); // Enable error logging
// error_reporting(E_ALL);
// require "config/app.php";
// require "core/Database.php";

// header('Content-Type: application/json'); // Ensure JSON response

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     try {
//         // Initialize the database connection
//         $sam = new Database();
//         $pdo = $sam->connect();

//         // Retrieve and sanitize input data
//         $headers = $_POST['headers'] ?? [];
//         $questions = $_POST['questions'] ?? [];
//         $inputTypes = $_POST['input_types'] ?? [];
//         $optionsArray = $_POST['options'] ?? [];
//         $token = bin2hex(random_bytes(3)) . uniqid();

//         // Validate the data
//         if (
//             !empty($questions) && 
//             count($questions) === count($inputTypes) && 
//             count($questions) === count($optionsArray) && 
//             count($questions) === count($headers)
//         ) {
//             // Start database transaction
//             $pdo->beginTransaction();

//             $stmt = $pdo->prepare("
//                 INSERT INTO questionnaires (header, question, input_type, options, token) 
//                 VALUES (:header, :question, :input_type, :options, :token)
//             ");

//             // Insert each question into the database
//             foreach ($questions as $index => $question) {
//                 $header = $headers[$index] ?? ''; // Ensure each question gets its respective header
//                 $inputType = $inputTypes[$index];
//                 $options = $optionsArray[$index] ?? '';

//                 $stmt->execute([
//                     ':header' => $header,
//                     ':question' => $question,
//                     ':input_type' => $inputType,
//                     ':options' => $options,
//                     ':token' => $token,
//                 ]);
//             }

//             // Commit transaction
//             $pdo->commit();

//             // Respond with success
//             echo json_encode([
//                 "status" => "success",
//                 "message" => "Questionnaire saved successfully!",
//                 "link" => "https://questionnaire.utpc.or.tz/apply?token={$token}"
//             ]);
//         } else {
//             // Respond with error for invalid data
//             echo json_encode([
//                 "status" => "error",
//                 "message" => "Invalid data provided! Ensure headers, questions, input types, and options are all filled correctly."
//             ]);
//         }
//     } catch (PDOException $e) {
//         // Handle database errors
//         if ($pdo->inTransaction()) {
//             $pdo->rollBack();
//         }
//         echo json_encode([
//             "status" => "error",
//             "message" => "Database error: " . $e->getMessage()
//         ]);
//     } catch (Exception $e) {
//         // Handle general errors
//         echo json_encode([
//             "status" => "error",
//             "message" => "Unexpected error: " . $e->getMessage()
//         ]);
//     }
// }