<?php

?>

<script>
    //Übergibt die Daten an JavaScript
<?php
$viewModel = array();
for ($i = 0; $i < 50; $i++) {
    $tempArray = array();
    $tempArray["ID"] = $i;
    $tempArray["Hersteller"] = "DELL";
    $tempArray["CPU"] = "Generic CPU";
    $viewModel[$i] = $tempArray;
}
$js_array = json_encode($viewModel);
echo "var javascript_array = " . $js_array . ";\n";
?>
</script>