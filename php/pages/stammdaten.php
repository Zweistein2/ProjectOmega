<?php

include("../database/stammdaten_sql.php");

$type = "";
$dbAlias = [
    "raeume" => true,
    "lieferant" => true,
    "hardware" => true,
    "komponentenarten" => true,
    "benutzer" => true,
    "komponentenattribute" => true
];

$prim = [
    HARDWARE => H_ID,
    ROOMS => R_ID,
    SUPPLIERS => L_ID,
    HARDWARE_KINDS => K_ID,
    ATTRIBUTES => A_ID
];

$dbElements = [
    "raeume" => array("r_id", "r_nr", "r_bezeichnung", "r_notiz"),
    "lieferant" => array("l_id", "l_firmenname", "l_strasse", "l_plz", "l_ort", "l_tel", "l_mobil", "l_fax", "l_email"),
    "hardware" => array("k_id", "raeume_r_id", "lieferant_l_id", "k_einkaufsdatum", "k_gewaehrleistungsdauer", "k_notiz", "k_hersteller", "komponentenarten_ka_id")
];

function excludeIdRow($data)
{
    global $prim;
    global $type;
    unset($data[$prim[$type]]);
    return $data;
}

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