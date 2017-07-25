<?php

$type = "";
$dbAlias = [
    "raeume" => true,
    "lieferant" => true,
    "komponenten" => true,
    "komponentenarten" => true,
    "benutzer" => true,
    "komponentenattribute" => true
];

if (isset($_GET["type"])) {
    $type = $_GET["type"];
    if (!isset($dbAlias[$type])) {
        die();
    }
} else {
    die();
}

include("stammdaten_modal.php");

?>