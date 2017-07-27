<?php
// * Created by PhpStorm.
// * Author: Fabian Karolat
// * Date: 25.07.2017
// * Time: 10:26

require_once('database.php');

function getRoomsByComponentType($type) {
    global $connection;
    $query = 'SELECT raeume.r_nr, raeume.r_bezeichnung, raeume.r_notiz
              FROM raeume LEFT JOIN hardware ON raeume.r_id = hardware.raeume_r_id 
              LEFT JOIN hardwarearten ON hardware.hardwarearten_ha_id = hardwarearten.ha_id
              WHERE hardwarearten.ha_hardwareart = "' . $type . '"
              AND raeume.r_id != 1
              GROUP BY r_nr';
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_all($result);
}

function getComponentsByRoomNumber($number) {
    global $connection;
    $query = 'SELECT hardwarearten.ha_hardwareart, hardware.h_name, hardware.h_bez
              FROM hardware LEFT JOIN raeume ON hardware.raeume_r_id = raeume.r_id
              LEFT JOIN hardwarearten ON hardware.hardwarearten_ha_id = hardwarearten.ha_id
              WHERE raeume.r_nr = "'. $number .'"
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
