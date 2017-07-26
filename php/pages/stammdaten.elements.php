<?php

include("../database/stammdaten_sql.php");

function dbElements()
{

    $hardwareElementOptions = [
        "ROOM_OPTIONS" => array("table" => ROOMS, "name" => H_ROOM_ID, "number" => R_NR, "id" => R_ID),
        "SUPPLIER_OPTIONS" => array("table" => SUPPLIERS, "name" => H_SUPPLIER_ID, "number" => L_COMPANY_NAME, "id" => L_ID),
    ];

    $hardwareElement = [
        "NAME" => "Hardware",
        "NAME_PLURAL" => "Hardware",
        "TABLE_NAME" => "hardware",
        "ID_COLUMN" => H_ID,
        "NAME_COLUMN" => H_NAME,
        "HIDDEN_COLUMNS" => array(H_ROOM_ID, H_SUPPLIER_ID, HA_A_ID),
        "ROOM_OPTIONS" => array(R_NR),
        "SUPPLIER_OPTIONS" => array(L_COMPANY_NAME),
        "OPTION_REFERENCE" => $hardwareElementOptions,
        H_ID => "#",
        H_NAME => "Name",
        R_NR => "Raumnummer",
        L_COMPANY_NAME => "Firma",
        H_ROOM_ID => "Raum #",
        H_SUPPLIER_ID => "Lieferant #",
        H_DESC => "Beschreibung",
        H_BUY_DATE => "Einkaufsdatum",
        H_WARRANTY => "Gewährleistungsdauer",
        H_NOTE => "Notiz",

    ];

    $roomElement = [
        "NAME" => "Raum",
        "NAME_PLURAL" => "Räume",
        "TABLE_NAME" => "raeume",
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
        "TABLE_NAME" => "lieferant",
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

    $softwareElement = [
        "NAME" => "Software",
        "NAME_PLURAL" => "Software",
        "TABLE_NAME" => "software",
        "ID_COLUMN" => S_ID,
        "NAME_COLUMN" => S_NAME,
        S_ID => "#",
        S_NAME => "Name",
        S_DESC => "Beschreibung",
        S_BUY_DATE => "Einkaufsdatum",
        S_LICENCE_DURATION => "Lizenzlaufzeit",
        S_NOTE => "Notiz",
        S_DEV => "Hersteller",
        S_VNR => "Versionsnummer",
        S_LICENCE_TYPE => "Lizenztyp",
        S_LICENCE_INFO => "Lizenzinformation",
        S_INSTALL => "Installationshinweis"

    ];

    $dbElements = [
        ROOMS => $roomElement,
        SUPPLIERS => $suppliersElement,
        SOFTWARE => $softwareElement,
        HARDWARE => $hardwareElement
    ];

    return $dbElements;

}

?>