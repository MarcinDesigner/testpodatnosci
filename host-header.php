<?php
// Host Header Injection - brak walidacji nagłówka Host
$host = $_SERVER["HTTP_HOST"] ?? "localhost";

// Używanie Host bez walidacji - podatne na cache poisoning
echo "Welcome to: " . $host . "<br>";
echo "Password reset link: http://" . $host . "/reset?token=12345";

