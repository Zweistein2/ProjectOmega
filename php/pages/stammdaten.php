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

$dbElements = [
    "raeume" => array("r_id", "r_nr", "r_bezeichnung", "r_notiz"),
    "lieferant" => array("l_id", "l_firmenname", "l_strasse", "l_plz", "l_ort", "l_tel", "l_mobil", "l_fax", "l_email")
];

if (isset($_GET["type"])) {
    $type = $_GET["type"];
    if (!isset($dbAlias[$type])) {
        die();
    }
} else {
    die();
}

include("../database/stammdaten_sql.php");
include("stammdaten_modal.php");

?>