<?php
include_once('database.php');
$ausmusterRoom = 1;

function moveHardware($moveString)
{
    global $ausmusterRoom;
    global $connection;
    foreach ($moveString AS $item) {
        if ($item != "") {
            $query = "UPDATE hardware SET raeume_r_id = ".$ausmusterRoom." WHERE h_id = ".$item.";";
            mysqli_query($connection, $query);
        }
    }
}

function getHardware($art)
{
    global $ausmusterRoom;
    global $connection;
    global $hardwareArray;
    $hardwareArray = array();

    $query = "select h_name,  h_bez AS bez, raeume_r_id FROM hardware AS h WHERE raeume_r_id != ".$ausmusterRoom." AND h.hardwarearten_ha_id = (SELECT ha_id FROM hardwarearten WHERE '" . $art . "' = ha_hardwareart)";
    $tempHardware = mysqli_query($connection, $query);
    $hardwareArray = mysqli_fetch_all($tempHardware);
    return $hardwareArray;
}

function getHardwarearten()
{
    global $hardwarearten;
    global $connection;
    $hardwarearten = array();
    $query = "select ha_hardwareart AS art from hardwarearten AS haArt WHERE 0 < (SELECT SUM(ha_id) FROM hardware WHERE hardwarearten_ha_id = haArt.ha_id GROUP BY  hardwarearten_ha_id)";
    $tempHardwarearten = mysqli_query($connection, $query);
    while ($hardArtResult = mysqli_fetch_assoc($tempHardwarearten)) {
        $hardwarearten[] = $hardArtResult["art"];
    }
    return $hardwarearten;
}