<?php
// Session Fixation - brak regeneracji ID sesji
session_start();

if (!isset($_SESSION["user"])) {
    // Brak regeneracji session ID po logowaniu
    $_SESSION["user"] = $_GET["user"] ?? "guest";
    $_SESSION["role"] = "user";
}

echo "Session ID: " . session_id() . "<br>";
echo "User: " . $_SESSION["user"] . "<br>";
echo "Role: " . $_SESSION["role"] . "<br>";
echo "<p>Warning: Session ID not regenerated after login</p>";

