<?php
// Celowo podatne na XSS - brak escapowania outputu
header("Content-Type: text/html; charset=UTF-8");

$name = $_GET["name"] ?? "Guest";
$message = $_GET["message"] ?? "";

?>
<!DOCTYPE html>
<html>
<head>
    <title>XSS Test Page</title>
</head>
<body>
    <h1>Witaj, <?php echo $name; ?>!</h1>
    <!-- Celowo brak escapowania - podatne na XSS -->
    <p>Twoja wiadomość: <?php echo $message; ?></p>
    
    <!-- Przykłady XSS payloads:
    ?name=<script>alert('XSS')</script>
    ?message=<img src=x onerror=alert('XSS')>
    ?name=<svg onload=alert('XSS')>
    -->
    
    <form method="GET">
        <input type="text" name="name" placeholder="Imię" value="<?php echo $name; ?>">
        <input type="text" name="message" placeholder="Wiadomość" value="<?php echo $message; ?>">
        <button type="submit">Wyślij</button>
    </form>
</body>
</html>

