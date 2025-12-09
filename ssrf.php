<?php
// Podatne na SSRF - brak walidacji URL
$url = $_GET["url"];

echo file_get_contents($url);

