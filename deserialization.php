<?php
// Insecure Deserialization - brak walidacji
$data = $_GET["data"] ?? "";

if ($data) {
    // Niebezpieczna deserializacja bez walidacji
    $unserialized = unserialize(base64_decode($data));
    echo "<pre>";
    print_r($unserialized);
    echo "</pre>";
} else {
    // Przykładowe dane do serializacji
    $test_data = [
        "user" => "admin",
        "role" => "admin",
        "command" => "whoami"
    ];
    echo "Serialized data: " . base64_encode(serialize($test_data));
}

