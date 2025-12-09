<?php
// Brak rate limiting - podatne na brute force
header("Content-Type: application/json");

$users = [
    "admin" => "admin",
    "user" => "password",
    "test" => "123456"
];

$username = $_GET["user"] ?? $_POST["user"] ?? "";
$password = $_GET["pass"] ?? $_POST["pass"] ?? "";

// Brak rate limiting - można próbować nieskończenie wiele razy
if (isset($users[$username]) && $users[$username] === $password) {
    $token = base64_encode(json_encode([
        "user" => $username,
        "role" => $username === "admin" ? "admin" : "user",
        "exp" => time() + 3600
    ]));
    
    echo json_encode([
        "success" => true,
        "token" => $token,
        "user" => $username
    ]);
} else {
    http_response_code(401);
    echo json_encode([
        "success" => false,
        "error" => "Invalid credentials"
    ]);
}

