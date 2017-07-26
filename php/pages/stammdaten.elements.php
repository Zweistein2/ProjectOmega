<?php

function dbElements()
{

    $hardwareElement = [
        "NAME" => "Software",
        "NAME_PLURAL" => "Software",
        "TABLE_NAME" => "hardware",
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

    $dbElements = [
        ROOMS => $roomElement,
        SUPPLIERS => $suppliersElement,
        HARDWARE => $hardwareElement,
    ];

    return $dbElements;

}

?>