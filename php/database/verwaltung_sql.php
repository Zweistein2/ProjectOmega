<?php

require_once('database.php');

function getHardwareAttributesByType($type)
{
    global $connection;
    $query = 'SELECT hat_bezeichnung 
              FROM hardwareattribute LEFT JOIN hardware_hat_attribute ON hardwareattribute.hat_id = hardware_hat_attribute.hardwareattribute_hat_id
              LEFT JOIN hardware ON hardware_hat_attribute.hardware_h_id = hardware.h_id
              LEFT JOIN hardwarearten ON hardware.hardwarearten_ha_id = hardwarearten.ha_id
              WHERE hardwarearten.ha_hardwareart = "' . $type . '"
              GROUP BY hat_bezeichnung';
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_all($result);
}

function getHardwareByType($type)
{
    global $connection;
    $query = 'SELECT hardware_hat_attribute.hhhat_wert, hardware.h_name, raeume.r_nr, hardware.h_id
              FROM hardware INNER JOIN hardware_hat_attribute ON hardware.h_id = hardware_hat_attribute.hardware_h_id
              INNER JOIN hardwarearten ON hardware.hardwarearten_ha_id = hardwarearten.ha_id
              INNER JOIN hardwareattribute ON hardwareattribute.hat_id = hardware_hat_attribute.hardwareattribute_hat_id
              INNER JOIN raeume ON hardware.raeume_r_id = raeume.r_id
              WHERE hardwarearten.ha_hardwareart = "' . $type . '"
              AND hardwareattribute.hat_bezeichnung = "Seriennummer"
              AND hardware.raeume_r_id != 1
              GROUP BY hardware.h_id';
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_all($result);
}

function getFilledHardwareTypes()
{
    global $connection;
    $query = 'SELECT ha_hardwareart AS art
              FROM hardwarearten AS haArt
              WHERE 0 < (SELECT SUM(ha_id)
                         FROM hardware
                         WHERE hardwarearten_ha_id = haArt.ha_id
                         GROUP BY  hardwarearten_ha_id)';
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_all($result);
}

function getSuppliers() {
    global $connection;
    $query = 'SELECT l_firmenname FROM lieferant';
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_all($result);
}

function getRooms() {
    global $connection;
    $query = 'SELECT r_nr FROM raeume WHERE raeume.r_id != 1';
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_all($result);
}

function getHardwareTypes() {
    global $connection;
    $query = 'SELECT ha_hardwareart FROM hardwarearten';
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_all($result);
}

function deleteRowByHardwareID($id)
{
    global $connection;
    $query = "UPDATE hardware
              SET raeume_r_id = 1
              WHERE hardware.h_id = {$id}";
    $result = mysqli_query($connection, $query);
    return $result;
}

function insertHardware($typeId, $vendorId, $roomId, $name, $manufactorId, $bez, $warranty, $note, $amount, $attrArray)
{

    global $connection;
    for ($i = 0; $i < $amount; $i++) {

        $query = "INSERT INTO hardware (raeume_r_id, lieferant_l_id, h_name, h_bez, h_einkaufsdatum, h_gewaehrleistungsdauer, h_notiz, h_hersteller, hardwarearten_ha_id)
                VALUES ($roomId, $vendorId, '$name', '$bez', CURRENT_DATE, '$warranty', '$note', '$manufactorId', '$typeId' );

                ";

       mysqli_query($connection, $query);
       $id = mysqli_insert_id($connection);
        insertHardwareAttributes($id, $attrArray);
    }
}

function insertHardwareAttributes($hardwareId, $attrArray)
{
    global $connection;
    $query = "";
    foreach ($attrArray AS $item) {
        $query = "INSERT INTO hardware_hat_attribute(hardware_h_id, hardwareattribute_hat_id, hhhat_wert) 
                    VALUES($hardwareId, $item[0], '$item[1]');";
        mysqli_multi_query($connection, $query);
    }

}