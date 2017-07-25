<?php
require_once('../database/reporting_sql.php');
?>

<script>
    <?php
        $result = getRoomsByComponentType("PC");
        $viewModel = array();
        foreach($result as $array)
        {
            $viewModel[] = $array;
        }
        $js_array = json_encode($viewModel);
        echo "var javascript_array = " . $js_array . ";\n";
    ?>
</script>