<?php
// JWT Weaknesses - alg=none, weak secret, brak weryfikacji
header("Content-Type: application/json");

$token = $_GET["token"] ?? "";

if ($token) {
    $parts = explode(".", $token);
    if (count($parts) === 3) {
        $header = json_decode(base64_decode($parts[0]), true);
        $payload = json_decode(base64_decode($parts[1]), true);
        
        // Brak weryfikacji podpisu - akceptuje alg=none
        echo json_encode([
            "header" => $header,
            "payload" => $payload,
            "warning" => "No signature verification - accepts alg=none"
        ]);
    }
} else {
    // Generuj słaby JWT z alg=none
    $header = base64_encode(json_encode(["alg" => "none", "typ" => "JWT"]));
    $payload = base64_encode(json_encode([
        "user" => "admin",
        "role" => "admin",
        "exp" => time() + 3600
    ]));
    
    echo json_encode([
        "token" => $header . "." . $payload . ".",
        "weak_secret" => "secret123",
        "note" => "Weak secret and accepts alg=none"
    ]);
}

