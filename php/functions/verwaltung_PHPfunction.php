<?php
//include("../database/database.php");

$viewModel = array();
$connection = null;
$hardwareArtenArray = getHardwarearten($connection);
$hardwareArray = getHardware($connection);

$art = $_GET["art"];
$viewModel = array();
$artID = 0;

//if($art == "pc") {
//    for ($i = 0; $i < 50; $i++) {
//        $tempArray = array();
//        $tempArray["ID"] = $i+200;
//        $tempArray["Hersteller"] = "Generic PC";
//        $tempArray["CPU"] = "R 203";
//        $tempArray["marked"] = true;
//        $viewModel[$i] = $tempArray;
//    }
//}
//else{
//    for ($i = 0; $i < 50; $i++) {
//        $tempArray = array();
//        $tempArray["ID"] = $i;
//        $tempArray["Hersteller"] = "Generic Switch ";
//        $tempArray["CPU"] = "R 202 ";
//        $tempArray["marked"] = "false";
//        $viewModel[$i] = $tempArray;
//    }
//}

function getHardware($connection){
//    $query = "select h_id AS id, raeume_r_id, h_bez AS bez FROM hardware";
//    $tempHardware = mysqli_query($connection, $query);
//    $hardwareArray = mysqli_fetch_all($tempHardware);

    global $hardwareArray;
    $hardwareArray = array();
    $hardwareArray[] = array(1, "Computer 2", "Raum 1", false);
    $hardwareArray[] = array(1, "Computer 3", "Raum 3", false);
    $hardwareArray[] = array(1, "Computer 4", "Raum 2", false);
    $hardwareArray[] = array(1, "Computer 5", "Raum 4", false);
    $hardwareArray[] = array(1, "Computer 6", "Raum 2", false);
    $hardwareArray[] = array(1, "Computer 7", "Raum 4", false);
    $hardwareArray[] = array(1, "Computer 8", "Raum 3", false);
    $hardwareArray[] = array(1, "Computer 9", "Raum 1", false);
    $hardwareArray[] = array(1, "Computer 10", "Raum 2", false);
    $hardwareArray[] = array(1, "Computer 12", "Raum 1", false);
    $hardwareArray[] = array(1, "Computer 13", "Raum 2", false);
    $hardwareArray[] = array(1, "Computer 14", "Raum 3", false);

    return $hardwareArray;
}

function getHardwarearten($connection){
      global $hardwarearten;
      $hardwarearten =  array();
//    $query = "select ha_hardwareart AS art from hardwarearten";
//    $tempHardwarearten = mysqli_query($connection, $query);
//    while($hardArtResult = mysqli_fetch_assoc($tempHardwarearten)){
//        $hardwarearten[] = $hardArtResult;
//    }

    $hardwarearten[] = "PC";
    $hardwarearten[] = "Switch";
    $hardwarearten[] = "Drucker";
    $hardwarearten[] = "Generic Gerät 1";
    $hardwarearten[] = "Gen Ger 2";
    $hardwarearten[] = "Gen Ger 3";

    return $hardwarearten;
}
?>

<script>
    //Übergibt die Daten an JavaScript
    <?php
    $js_array = json_encode($hardwareArray);
    echo "var hardwareArray = " . $js_array . ";\n";

    $js_array = json_encode($hardwareArtenArray);
    echo "var hardwareArtenArray = " . $js_array . ";\n";

    $js_param = json_encode($art);
    echo "var artParam = ". $js_param. ";\n";
    ?>
</script>