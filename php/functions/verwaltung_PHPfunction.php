<?php

include("../database/verwaltung_sql.php");

if(isset($_GET["del"])){
    $moveString = explode("_",$_GET["del"]);
    moveHardware($moveString);

    header("Location: verwaltung_ausmusterung.php?art=pc", true, 301);
    exit();
}
$art = "";
if(isset($_GET["art"])){
    $art = $_GET["art"];
}
if($art == ""){$art = "pc";}
$hardwareArtenArray = getHardwarearten();
$hardwareArray = getHardware($art);

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