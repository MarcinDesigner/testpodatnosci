<?php
// Config file z debug mode i wrażliwymi danymi
define("DEBUG", true);
define("APP_DEBUG", true);
define("ENVIRONMENT", "development");

// Wrażliwe dane w konfiguracji
define("DB_HOST", "localhost");
define("DB_USER", "admin");
define("DB_PASSWORD", "super_secret_password_123");
define("DB_NAME", "production_db");

define("API_SECRET", "sk_live_secret_key_123456789");
define("JWT_SECRET", "jwt_secret_key_123456");

// Debug info
if (DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

