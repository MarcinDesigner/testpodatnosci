<?php
// Open Redirect - brak walidacji URL
$url = $_GET["url"] ?? "/";

// Brak sprawdzania czy URL jest z dozwolonej domeny
header("Location: " . $url);
exit;

