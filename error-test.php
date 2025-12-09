<?php
// Verbose Error Messages - szczegółowe błędy
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Celowo wywołaj błąd z pełnym stack trace
$undefined_var = $non_existent_array["key"]["nested"]["deep"];

// Błąd z pełnymi ścieżkami
require_once("/nonexistent/path/to/file.php");

