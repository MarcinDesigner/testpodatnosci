<?php
// Celowo brak nagłówków bezpieczeństwa
// Brak autoryzacji, podatne na IDOR (Insecure Direct Object Reference)

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Content-Type: application/json");

// Brak walidacji, brak autoryzacji
$data = [
    1 => ["email" => "admin@example.com", "role" => "admin", "password" => "admin123", "ssn" => "123-45-6789"],
    2 => ["email" => "user@example.com", "role" => "user", "password" => "password123", "ssn" => "987-65-4321"],
    3 => ["email" => "test@example.com", "role" => "user", "password" => "test123", "ssn" => "555-55-5555"]
];

$id = $_GET["id"] ?? 1;

// Brak sprawdzania czy użytkownik ma dostęp do tego ID
if (isset($data[$id])) {
    echo json_encode($data[$id]);
} else {
    http_response_code(404);
    echo json_encode(["error" => "Not found"]);
}

