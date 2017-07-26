<?php
require_once('database.php');

function getHardwareAttributesByType($type) {
    global $connection;
    $query = 'SELECT hat_bezeichnung 
              FROM hardwareattribute LEFT JOIN hardware_hat_attribute ON hardwareattribute.hat_id = hardware_hat_attribute.hardwareattribute_hat_id
              LEFT JOIN hardware ON hardware_hat_attribute.hardware_h_id = hardware.h_id
              LEFT JOIN hardwarearten ON hardware.hardwarearten_ha_id = hardwarearten.ha_id
              WHERE hardwarearten.ha_hardwareart = "' . $type . '"';
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_all($result);
}

function getHardwareTypes() {
    global $connection;
    $query = 'SELECT ha_hardwareart FROM hardwarearten';
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_all($result);
}