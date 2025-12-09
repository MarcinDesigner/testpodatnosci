<?php
// Celowo podatne na SQL Injection - brak prepared statements
// Brak walidacji inputu

header("Content-Type: application/json");

// Symulacja bazy danych (w prawdziwej aplikacji byłoby połączenie z MySQL)
$users = [
    ["id" => 1, "name" => "Admin User", "email" => "admin@example.com"],
    ["id" => 2, "name" => "Test User", "email" => "test@example.com"],
    ["id" => 3, "name" => "John Doe", "email" => "john@example.com"]
];

$query = $_GET["q"] ?? "";

// Celowo podatne - bezpośrednie wstawienie do zapytania
// W prawdziwej aplikacji byłoby: "SELECT * FROM users WHERE name LIKE '%" . $query . "%'"
// Co pozwala na: ?q=' OR '1'='1

$results = [];
foreach ($users as $user) {
    if (stripos($user["name"], $query) !== false || stripos($user["email"], $query) !== false) {
        $results[] = $user;
    }
}

echo json_encode([
    "query" => $query,
    "results" => $results,
    "sql_injection_hint" => "Try: ?q=' OR '1'='1"
]);

