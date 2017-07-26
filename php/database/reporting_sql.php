<?php
require_once('database.php');

function getRoomsByComponentType($type) {
    global $connection;
    $query = 'SELECT raeume.r_nr, raeume.r_bezeichnung, raeume.r_notiz
              FROM raeume LEFT JOIN hardware ON raeume.r_id = hardware.raeume_r_id 
              LEFT JOIN hardwarearten ON hardware.hardwarearten_ha_id = hardwarearten.ha_id
              WHERE hardwarearten.ha_hardwareart = "' . $type . '"
              GROUP BY r_nr';
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_all($result);
}

function getComponentsByRoomNumber($number) {
    global $connection;
    $query = 'SELECT hardware.h_name, hardware.h_bez, hardwarearten.ha_hardwareart
              FROM hardware LEFT JOIN raeume ON hardware.raeume_r_id = raeume.r_id
              LEFT JOIN hardwarearten ON hardware.hardwarearten_ha_id = hardwarearten.ha_id
              WHERE raeume.r_nr = "'. $number .'"
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
