<?php
// Mass Assignment - brak filtrowania pól
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Przypisanie wszystkich pól POST bez filtrowania
    $user = $_POST;
    
    // Brak sprawdzania czy użytkownik nie próbuje ustawić role=admin
    echo json_encode([
        "success" => true,
        "user" => $user,
        "warning" => "Mass assignment vulnerability - all POST fields accepted"
    ]);
} else {
    ?>
    <form method="POST">
        <input name="username" placeholder="Username">
        <input name="email" placeholder="Email">
        <input name="role" value="user" type="hidden">
        <button>Create User</button>
    </form>
    <p>Try: Set role=admin in form data</p>
    <?php
}

