<?php
// HTTP Parameter Pollution - brak walidacji wielokrotnych parametrów
header("Content-Type: application/json");

$user = $_GET["user"] ?? "";
$role = $_GET["role"] ?? "user";

// Brak sprawdzania czy są wielokrotne parametry
// ?user=admin&user=attacker&role=admin&role=user
echo json_encode([
    "user" => $user,
    "role" => $role,
    "all_users" => $_GET["user"] ?? [],
    "all_roles" => $_GET["role"] ?? [],
    "note" => "Vulnerable to parameter pollution"
]);

