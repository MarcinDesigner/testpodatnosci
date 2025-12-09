<?php
// Insecure Password Reset - przewidywalne tokeny, brak wygaśnięcia
header("Content-Type: application/json");

$token = $_GET["token"] ?? "";
$email = $_GET["email"] ?? "";

if ($token) {
    // Token w URL - podatne na wyciek
    // Przewidywalny token (MD5 email + timestamp)
    $expected_token = md5($email . "2024-01-01");
    
    if ($token === $expected_token) {
        echo json_encode([
            "success" => true,
            "message" => "Token valid - password reset allowed",
            "vulnerabilities" => [
                "token_in_url",
                "predictable_token",
                "no_expiration"
            ]
        ]);
    } else {
        echo json_encode(["success" => false, "error" => "Invalid token"]);
    }
} else {
    // Generuj przewidywalny token
    $token = md5($email . "2024-01-01");
    echo json_encode([
        "token" => $token,
        "email" => $email,
        "reset_link" => "password-reset.php?token=" . $token . "&email=" . $email,
        "warning" => "Predictable token, no expiration, token in URL"
    ]);
}

