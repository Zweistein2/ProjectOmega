<?php

include("../database/stammdaten_sql.php");

function dbElements()
{

    $hardwareElement = [
        "NAME" => "Hardware",
        "NAME_PLURAL" => "Hardware",
        "TABLE_NAME" => "hardware",
        "ID_COLUMN" => H_ID,
        "NAME_COLUMN" => H_NAME,
        "HIDDEN_COLUMNS" => array(H_ROOM_ID, H_SUPPLIER_ID),
        "ROOM_OPTIONS" => R_NR,
        "SUPPLIER_OPTIONS" => L_COMPANY_NAME,
        H_ID => "#",
        H_NAME => "Name",
        H_STATUS => "Status",
        R_NR => "Raumnummer",
        L_COMPANY_NAME => "Firma",
        S_ROOM_ID => "Raum #",
        S_SUPPLIER_ID => "Lieferant #",
        H_DESC => "Beschreibung",
        H_BUY_DATE => "Einkaufsdatum",
        H_WARRANTY => "Gewährleistungsdauer",
        H_NOTE => "Notiz",
        H_DEV => "Hersteller"

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
        "HIDDEN_COLUMNS" => array(S_ROOM_ID, S_SUPPLIER_ID),
        S_ID => "#",
        S_ROOM_ID => "Raum #",
        S_SUPPLIER_ID => "Lieferant #",
        S_STATUS => "Status",
        S_NAME => "Name",
        R_NR => "Raumnummer",
        L_COMPANY_NAME => "Firma",
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