<?php

include("../database/stammdaten_sql.php");
include("../database/user_sql.php");

function dbElements()
{

    $hardwareElementOptions = [
        "ROOM_OPTIONS" => array("table" => ROOMS, "id" => H_ROOM_ID, "value" => R_NR, "originalId" => R_ID),
        "SUPPLIER_OPTIONS" => array("table" => SUPPLIERS, "id" => H_SUPPLIER_ID, "value" => L_COMPANY_NAME, "originalId" => L_ID),
        "KIND_OPTIONS" => array("table" => HARDWARE_KINDS, "id" => H_KIND_ID, "value" => K_NAME, "originalId" => K_ID),
    ];


    $hardwareElement = [
        "NAME" => "Hardware",
        "NAME_PLURAL" => "Hardware",
        "TABLE_NAME" => "hardware",
        "ID_COLUMN" => H_ID,
        "NAME_COLUMN" => H_NAME,
        "HIDDEN_COLUMNS" => array(H_ROOM_ID, H_SUPPLIER_ID, HA_A_ID, H_KIND_ID),
        "ROOM_OPTIONS" => array(R_NR),
        "SUPPLIER_OPTIONS" => array(L_COMPANY_NAME),
        "KIND_OPTIONS" => array(K_NAME),
        "OPTION_REFERENCE" => $hardwareElementOptions,
        H_ID => "#",
        H_NAME => "Name",
        K_NAME => "Hardwareart",
        R_NR => "Raumnummer",
        L_COMPANY_NAME => "Firma",
        H_ROOM_ID => "Raum #",
        H_SUPPLIER_ID => "Lieferant #",
        H_DESC => "Beschreibung",
        H_BUY_DATE => "Einkaufsdatum",
        H_WARRANTY => "Gewährleistungsdauer",
        H_NOTE => "Notiz",
        H_KIND_ID => "Hardwareart #",

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

    $userElementOptions = [
        "ROLE_OPTIONS" => array("table" => USERS, "id" => H_ROOM_ID, "value" => R_NR, "originalId" => R_ID),
    ];

    $userElement = [
        "NAME" => "Benutzer",
        "NAME_PLURAL" => "Benutzer",
        "TABLE_NAME" => "users",
        "ID_COLUMN" => U_ID,
        "NAME_COLUMN" => U_USERNAME,
        "ROLE_OPTIONS" => array(U_ROLES_ROLE),
        "OPTION_REFERENCE" => $userElementOptions,
        U_ID => "#",
        U_USERNAME => "Benutzername",
        U_ROLES_ID => "Rolle #",
        U_ROLES_ROLE => "Rolle",
    ];

    $dbElements = [
        ROOMS => $roomElement,
        SUPPLIERS => $suppliersElement,
        SOFTWARE => $softwareElement,
        HARDWARE => $hardwareElement,
        USERS => $userElement,
    ];

    return $dbElements;

}

?>