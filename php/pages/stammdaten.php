<?php

//stammdaten.php
//Kopfdatei für stammdaten_komponenten.php

include("../database/stammdaten_sql.php");
include("stammdaten_modal.php");

$type = "";

/**
 * @dbAlias: Enthält die Tabellennamen für SQL-Operationen, richtige Anwendung von dbElements und translator und
 *           um den Type auf richtigkeit zu prüfen.
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

//dbElements: Enthält die Spaltennamen für SQL-Funktionen.
$dbElements = [
    "raeume" => array("r_id", "r_nr", "r_bezeichnung", "r_notiz"),
    "lieferant" => array("l_id", "l_firmenname", "l_strasse", "l_plz", "l_ort", "l_tel", "l_mobil", "l_fax", "l_email"),
    "hardware" => array("k_id", "raeume_r_id", "lieferant_l_id", "k_einkaufsdatum", "k_gewaehrleistungsdauer", "k_notiz", "k_hersteller", "komponentenarten_ka_id")
];

//translator: Anzeigenamen für die dbElements
$translator = [
    "raeume" => array("#", "Nummer", "Bezeichnung", "Notiz"),
    "lieferant" => array("#", "Firmenname", "Strasse", "PLZ", "Ort", "Tel", "Mobil", "Fax", "E-Mail"),
    "hardware" => array("#", "Raum #", "Lieferant #", "Einkaufsdatum", "Gewaehrleistungsdauer", "Notiz", "Hersteller", "Komponentenarten #")
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
        header("Location: " . $_SERVER['PHP_SELF'] . "?type=raeume");
        die();
    }
}

/**
 * @excludeIdRow: Exkludiert die ID-Spalte aus einem Objekt.
 * Da die ID in vielen Fällen nicht benötigt wird, soll diese ausgeschlossen werden.
 * Parameter data: Das zu bearbeitende Objekt
 * Ausgabe: Das über Parameter übergebene Objekt ohne die ID-Spalte.
 */

function excludeIdRow($data)
{
    //global $prim;
    //global $type;
    //unset($data[$prim[$type]]);
    array_shift($data);
    return $data;
}

?>