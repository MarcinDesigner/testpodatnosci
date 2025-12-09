<?php
// XPATH Injection - brak walidacji w zapytaniach XPath
$name = $_GET["name"] ?? "";

// Symulacja podatnego zapytania XPath
// Podatne na: ' or '1'='1
$xpath = "//user[name='" . $name . "']";

echo "XPath Query: " . htmlspecialchars($xpath) . "<br>";
echo "Try: ?name=' or '1'='1";

