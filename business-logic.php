<?php
// Business Logic Flaws - ujemne ceny, brak walidacji
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $price = floatval($_POST["price"] ?? 0);
    $quantity = intval($_POST["quantity"] ?? 1);
    
    // Brak walidacji - można ustawić ujemną cenę lub ilość
    $total = $price * $quantity;
    
    echo json_encode([
        "price" => $price,
        "quantity" => $quantity,
        "total" => $total,
        "warning" => "No validation - accepts negative prices/quantities"
    ]);
} else {
    ?>
    <form method="POST">
        <input type="number" name="price" placeholder="Price" value="100">
        <input type="number" name="quantity" placeholder="Quantity" value="1">
        <button>Calculate</button>
    </form>
    <p>Try: Set price=-1000 or quantity=-10</p>
    <?php
}

