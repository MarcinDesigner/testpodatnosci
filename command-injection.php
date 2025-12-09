<?php
// Command Injection - brak walidacji inputu
$cmd = $_GET["cmd"] ?? "whoami";

// Niebezpieczne użycie shell_exec bez walidacji
echo "<pre>";
echo shell_exec($cmd);
echo "</pre>";

