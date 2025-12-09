<?php
// CORS misconfiguration - podatne
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

echo json_encode(["message" => "CORS vulnerable", "data" => "sensitive_data_123"]);

