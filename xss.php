<?php
// Podatne na XSS - brak escapowania
echo "Wynik: ".$_GET["q"];

