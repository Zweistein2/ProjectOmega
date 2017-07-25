<?php

?>

<script>
    //Übergibt die Daten an JavaScript
    <?php
    /*    $tag = $_GET["art"];
        if($tag = null){
            $tag = "pc";
        }
        echo "console.log(".$tag.");";*/
    //Falls die Datenbank jemlas funktioniert wird durch ein Abfrage
    //$viewModel gefüllt und wird dan an JavaScript übergeben

    $viewModel = array();

    if($tag = "pc") {
        for ($i = 0; $i < 50; $i++) {
            $tempArray = array();
            $tempArray["ID"] = $i+200;
            $tempArray["Hersteller"] = "Generic PC";
            $tempArray["CPU"] = "R 203";
            $tempArray["marked"] = "false";
            $viewModel[$i] = $tempArray;
        }
    }
    else{
        for ($i = 0; $i < 50; $i++) {
            $tempArray = array();
            $tempArray["ID"] = $i;
            $tempArray["Hersteller"] = "Generic Switch ";
            $tempArray["CPU"] = "R 202 ";
            $tempArray["marked"] = "false";
            $viewModel[$i] = $tempArray;
        }
    }
    $js_array = json_encode($viewModel);
    echo "var javascript_array = " . $js_array . ";\n";
    ?>
</script>