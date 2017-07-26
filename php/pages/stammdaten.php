<?php

//stammdaten.php
//Kopfdatei für stammdaten_komponenten.php

include("../database/stammdaten_sql.php");
include("stammdaten_modal.php");

$type = "";

/**
 * @dbAlias: Enthält die Tabellennamen für SQL-Operationen, keys für dbElements und translator und
 *           um den Type auf Richtigkeit zu prüfen.
 */

$dbAlias = [
    "raeume" => true,
    "lieferant" => true,
    "hardware" => true,
    "komponentenarten" => true,
    "benutzer" => true,
    "komponentenattribute" => true
];

//prim: Enthält die ID-Spalten für SQL-Operationen.
$prim = [
    HARDWARE => H_ID,
    ROOMS => R_ID,
    SUPPLIERS => L_ID,
    HARDWARE_KINDS => K_ID,
    ATTRIBUTES => A_ID
];

function getColumnNames($type, $includeId)
{
    return getColumn($type, false, $includeId);
}

function getColumnText($type, $includeId)
{
    return getColumn($type, true, $includeId);
}

function getColumn($type, $value, $includeId)
{
    global $dbElements;
    $element = $dbElements[$type];
    unset($element['NAME']);
    unset($element['NAME_PLURAL']);
    unset($element['NAME_COLUMN']);
    if (!$includeId) {
        $idColumn = $element["ID_COLUMN"];
        unset($element[$idColumn]);
    }
    if ($value) {
        return array_keys($element);
    } else {
        return array_values($element);
    }
}

function getTypeName($type, $plural)
{
    global $dbElements;
    $element = $dbElements[$type];
    $returnVal = $element['NAME'];
    if ($plural) {
        $returnVal = $element['NAME_PLURAL'];
    }
    return $returnVal;
}

function getIDColumn($type)
{
    global $dbElements;
    $element = $dbElements[$type];
    return $element['ID_COLUMN'];
}

function getNameColumn($type)
{
    global $dbElements;
    $element = $dbElements[$type];
    return $element['NAME_COLUMN'];
}

$dbElements = [
    ROOMS => $roomElement,
    SUPPLIERS => $suppliersElement,
    HARDWARE => $hardwareElement,
];

$hardwareElement = [
    "NAME" => "Software",
    "NAME_PLURAL" => "Software",
    "ID_COLUMN" => H_ID,
    "NAME_COLUMN" => H_NAME,
    H_ID => "#",
    H_NAME => "Name",
    H_STATUS => "Status",
    H_BEZ => "Beschreibung",
    H_BUY_DATE => "Einkaufsdatum",
    H_WARRANTY => "Gewährleistungsdauer",
    H_NOTE => "Notiz",
    H_DEV => "Hersteller"

];

$roomElement = [
    "NAME" => "Raum",
    "NAME_PLURAL" => "Räume",
    "ID_COLUMN" => R_ID,
    "NAME_COLUMN" => R_NR,
    R_ID => "#",
    R_NR => "Raumnummer",
    R_DESC => "Beschreibung",
    R_NOTE => "Notiz",
];

$suppliersElement = [
    "NAME" => "Lieferant",
    "NAME_PLURAL" => "Lieferanten",
    "ID_COLUMN" => L_ID,
    "NAME_COLUMN" => L_COMPANY_NAME,
    L_ID => "#",
    L_COMPANY_NAME => "Firmenname",
    L_STREET => "Straße",
    L_PLZ => "PLZ",
    L_TOWN => "Ort",
    L_TEL => "Telefon",
    L_MOBILE => "Mobil",
    L_FAX => "Fax",
    L_EMAIL => "E-Mail"
];

getType();

/**
 * @getType: Prüft ob der GET-Parameter 'type' gesetzt wurde.
 * Mittels Type wird bestimmt welche Datenbank angesprochen werden soll.
 * Diese Funktion prüft ob ein legaler Type vorliegt, falls nicht wird die Ausführung verweigert.
 * Falls kein Type gesetzt wurde, wird auf den Type 'raeume' weitergeleitet.
 * Achtung: Muss in der PHP-Datei aufgerufen werden!
 */
function getType()
{
    if (isset($_GET["type"])) {
        $type = $_GET["type"];
        if (!isset($dbAlias[$type])) {
            die();
        }
    } else {
        reset($dbAlias);
        $first_key = key($dbAlias);
        header("Location: " . $_SERVER['PHP_SELF'] . "?type=" . $first_key);
        die();
    }
}

?>