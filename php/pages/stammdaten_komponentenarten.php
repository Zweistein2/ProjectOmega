<html>
<head>
    <title>Stammdaten</title>
    <?php include_once("../template/head.template.php"); ?>
    <link href="../../css/stammdaten.css" rel="stylesheet">
</head>
<body>
<?php
include_once("../template/sidebar.template.php");
include_once("../database/stammdaten_sql.php");

$selectedKind = 0;
foreach($_POST as $key => $val){
    $arr = explode('_', $key);
    if($arr[0] == 'show'){
        $selectedKind = $arr[2];
    }else if($arr[0] == 'update'){
        if($arr[1] == ''){

        }else if($arr[1] == ''){

        }
    }else if($arr[0] == 'delete'){
        if($arr[1] == ''){

        }else if($arr[1] == ''){

        }
    }
}
?>
<div class="container">
    <h2>Stammdaten</h2>
    <form method="post" name="formKinds" action="stammdaten_komponentenarten.php"/>
    <div class="row">
        <div class="col col-md-5">
            <div class="panel panel-default panel-table">
                <div class="panel-body">
                    <table class="table table-striped table-list">
                        <thead>
                            <tr>
                                <?php
                                $headers = ['ID' => K_ID, 'Hardware-Art' => K_NAME];
                                foreach($headers as $key => $val){
                                    echo '<th>'.$key.'</th>';
                                }
                                ?>
                                <th><span class="glyphicon glyphicon-menu-hamburger"></th> <!--Attribute-->
                                <th><span class="glyphicon glyphicon-edit"></span></th><!--Ändern -->
                                <th><span class="glyphicon glyphicon-remove"></span></th><!--Löschen -->
                            </tr>
                        </thead>
                        <tbody>
                        <?php

                        $result = getEntriesByTable(HARDWARE_KINDS);
                        while($data = mysqli_fetch_assoc($result)){
                            echo '<tr>';
                            foreach($headers as $val){
                                echo '<td>'.$data[$val].'</td>';
                            }
                            echo '<td><input type="submit" name="show_attrs_'.$data[K_ID].'" value="Attribute"/></td>';
                            echo '<td><input type="submit" name="update_attr_'.$data[K_ID].'" value="update"/></td>';
                            echo '<td><input type="submit" name="delete_kind_'.$data[K_ID].'" value="X"/></td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col col-xs-4">
                                <button type="submit" class="btn btn-success">Neuen Datensatz anlegen</button>
                            </div>
                            <div class="col col-xs-8">
                                <ul class="pagination hidden-xs pull-right">
                                    <li><a href="#"><<</a></li>
                                    <li><a href="#"><</a></li>
                                    <li class="active"><a href="#">3</a></li>
                                    <li><a href="#">></a></li>
                                    <li><a href="#">>></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        showAttributes($selectedKind);
        ?>
    </div>
</body>
</html>

<?php function showAttributes($k_id){
    if($k_id == 0) return;
    ?>
    <div class="col col-md-5">
        <div class="panel panel-default panel-table">
            <div class="panel-body">
                <table class="table table-striped table-list">
                    <thead>
                    <?php
                    echo '<tr>';
                    $attr_headers = ['ID' => A_ID, 'Bezeichnung' => A_DESC];
                    foreach($attr_headers as $key => $val){
                        echo '<th>'.$key.'</th>';
                    }
                    echo '<th><span class="glyphicon glyphicon-edit"></span></th>'; //--Ändern
                    echo '<th><span class="glyphicon glyphicon-remove"></span></th>'; //--Löschen
                    echo '</tr>';
                    echo '</thead>';

                    echo '<tbody>';
                    $result = getAttributesByKindID($k_id);
                    while($data = mysqli_fetch_assoc($result)){
                        echo '<tr>';
                        foreach($attr_headers as $key => $val){
                            echo '<td>'.$data[$val].'</td>';
                        }
                        echo '<td><input type="submit" name="update_attr_'.$data[A_ID].'" value="Ändern"/></td>';
                        echo '<td><input type="submit" name="delete_attr_'.$data[A_ID].'" value="X"/></td>';
                        echo '</tr>';
                    }
                    ?>
                    </tbody>
                </table>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col col-xs-4">
                            <button type="submit" class="btn btn-success">Neuen Datensatz anlegen</button>
                        </div>
                        <div class="col col-xs-8">
                            <ul class="pagination hidden-xs pull-right">
                                <li><a href="#"><<</a></li>
                                <li><a href="#"><</a></li>
                                <li class="active"><a href="#">3</a></li>
                                <li><a href="#">></a></li>
                                <li><a href="#">>></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- TODO: Refactoring! -->