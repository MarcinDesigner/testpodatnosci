<?php
// Information Disclosure w Headers - celowo ujawnione informacje
header("X-Powered-By: PHP/7.4.0");
header("Server: Apache/2.4.41 (Unix)");
header("X-Debug-Version: 2.8.1");
header("X-Framework: Custom Framework v1.0");
header("X-Database: MySQL 5.7.30");

echo "Headers exposed - check response headers";

