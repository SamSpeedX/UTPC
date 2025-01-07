<?php

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

$stmt = $kibalanga->prepare($sql);
$stmt->execute();