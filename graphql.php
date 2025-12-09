<?php
// Podatny GraphQL endpoint - brak walidacji query
header("Content-Type: application/json");

$query = $_GET["query"] ?? "";

// Brak walidacji GraphQL query - podatne na injection
if (strpos($query, "users") !== false) {
    echo json_encode([
        "data" => [
            "users" => [
                ["id" => 1, "email" => "admin@example.com", "password" => "admin123"],
                ["id" => 2, "email" => "user@example.com", "password" => "password123"]
            ]
        ]
    ]);
} else {
    echo json_encode(["data" => null]);
}

