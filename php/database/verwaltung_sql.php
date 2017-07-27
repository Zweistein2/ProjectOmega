<?php

require_once('database.php');

function getHardwareAttributesByType($type) {
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

function getHardwareByType($type) {
    global $connection;
    $query = 'SELECT hardware_hat_attribute.hhhat_wert, hardware.h_name, hardware.raeume_r_id, hardware.h_id
              FROM hardware LEFT JOIN hardware_hat_attribute ON hardware.h_id = hardware_hat_attribute.hardware_h_id
              LEFT JOIN hardwarearten ON hardware.hardwarearten_ha_id = hardwarearten.ha_id
              LEFT JOIN hardwareattribute ON hardwareattribute.hat_id = hardware_hat_attribute.hardwareattribute_hat_id
              WHERE hardwarearten.ha_hardwareart = "'. $type .'"
              AND hardwareattribute.hat_bezeichnung = "Seriennummer"
              AND hardware.raeume_r_id != 1
              GROUP BY hardware.h_id';
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_all($result);
}

function getHardwareTypes() {
    global $connection;
    $query = 'SELECT ha_hardwareart FROM hardwarearten';
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_all($result);
}

function deleteRowByHardwareID($id) {
    global $connection;
    $query = "UPDATE hardware
              SET raeume_r_id = 1
              WHERE hardware.h_id = {$id}";
    $result = mysqli_query($connection, $query);
    return $result;
}