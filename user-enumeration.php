<?php
// Email/Username Enumeration - różne komunikaty błędów
header("Content-Type: application/json");

$email = $_GET["email"] ?? "";
$password = $_GET["password"] ?? "";

$users = [
    "admin@example.com" => "admin123",
    "user@example.com" => "password123",
    "test@example.com" => "test123"
];

if (isset($users[$email])) {
    if ($users[$email] === $password) {
        echo json_encode(["success" => true, "message" => "Login successful"]);
    } else {
        // Różny komunikat dla istniejącego użytkownika
        echo json_encode(["success" => false, "error" => "Invalid password"]);
    }
} else {
    // Różny komunikat dla nieistniejącego użytkownika
    echo json_encode(["success" => false, "error" => "User not found"]);
}

