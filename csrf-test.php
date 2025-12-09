<?php
// CSRF - brak tokenów CSRF
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Brak weryfikacji tokenu CSRF
    $action = $_POST["action"] ?? "";
    $amount = $_POST["amount"] ?? 0;
    
    if ($action === "transfer") {
        echo json_encode([
            "success" => true,
            "message" => "Transferred $" . $amount . " without CSRF protection"
        ]);
    }
} else {
    ?>
    <form method="POST" action="csrf-test.php">
        <input type="hidden" name="action" value="transfer">
        <input type="number" name="amount" value="1000">
        <button type="submit">Transfer Money</button>
    </form>
    <?php
}

