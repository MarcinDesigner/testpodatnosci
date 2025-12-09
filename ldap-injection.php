<?php
// LDAP Injection - brak walidacji w zapytaniach LDAP
$username = $_GET["username"] ?? "";

// Symulacja podatnego zapytania LDAP
// Podatne na: *)(&
$filter = "(cn=" . $username . ")";

echo "LDAP Filter: " . htmlspecialchars($filter) . "<br>";
echo "Try: ?username=*)(&";

