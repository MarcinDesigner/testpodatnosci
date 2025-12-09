<?php
// Debug Mode Enabled - wyciek informacji
define("DEBUG", true);
define("APP_DEBUG", true);

if (DEBUG) {
    phpinfo();
    echo "<pre>";
    print_r($_SERVER);
    print_r($_ENV);
    echo "</pre>";
}

