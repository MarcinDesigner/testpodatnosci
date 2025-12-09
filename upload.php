<?php
// Celowo brak walidacji plików - podatne na RCE
// Brak sprawdzania typu MIME
// Brak sprawdzania rozszerzenia
// Pełne prawa zapisu

$uploadDir = __DIR__ . "/uploads/";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["file"])) {
    $file = $_FILES["file"];
    
    // Brak jakiejkolwiek walidacji
    $targetPath = $uploadDir . basename($file["name"]);
    
    // Brak sprawdzania typu pliku
    if (move_uploaded_file($file["tmp_name"], $targetPath)) {
        echo json_encode([
            "success" => true,
            "file" => "uploads/" . basename($file["name"]),
            "message" => "File uploaded successfully"
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "error" => "Upload failed"
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "error" => "No file provided"
    ]);
}

