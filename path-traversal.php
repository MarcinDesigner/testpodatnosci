<?php
// Podatne na Path Traversal - brak walidacji ścieżki
$file = $_GET["file"] ?? "index.html";

// Brak walidacji - można użyć ../../etc/passwd
echo file_get_contents($file);

