<?php
// Podatne na XXE (XML External Entity) - brak walidacji XML
libxml_disable_entity_loader(false);

$xml = $_POST["xml"] ?? file_get_contents("php://input");

if ($xml) {
    $dom = new DOMDocument();
    $dom->loadXML($xml, LIBXML_NOENT | LIBXML_DTDLOAD);
    echo $dom->textContent;
} else {
    echo "Send XML via POST";
}

