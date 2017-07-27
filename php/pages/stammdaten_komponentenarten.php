<?php
require_once("../authentication/auth_filter.php");
checkForMinAccess("Admin");
?>

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
if(!isset($_SESSION['selectedKindToShow'])){
    $_SESSION['selectedKindToShow'] = 0;
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
                            foreach ($headers as $key => $val) {
                                echo '<th>' . $key . '</th>';
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
                            echo '<td><a class="btn btn-warning" href="?operation=showAttributes&type=Art&id='.$data[K_ID].'">'
                                .'<span class=\"glyphicon glyphicon-pencil\"></span></a></td>';
                            echo '<td><a class="btn btn-primary" href="?operation=edit&type=Art&id='.$data[K_ID].'">'
                                . '<span class=\"glyphicon glyphicon-pencil\"></span></a></td>';
                            echo '<td><a class="btn btn-danger" href="?operation=delete&type=Art&id='.$data[K_ID].'">'
                                .'<span class=\"glyphicon glyphicon-remove\"></span></a></td>';
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
        checkKAModel();
        showAttributes($_SESSION['selectedKindToShow']);
        ?>
    </div>
</body>
</html>

<?php
function checkKAModel(){
    if (isset($_GET["operation"])) {
        $operation = $_GET["operation"];
        if($operation == 'showAttributes'){
            $id = isset($_GET["id"]) ? $_GET["id"] : 0;
            $_SESSION['selectedKindToShow'] = $id;
            //showAttributes($id);
        }else{
            $type = $_GET["type"];
            $id = $_GET["id"];
            showKAModel($type, $id, $type . ' mit ID ' . $id, 'formName', $type . ' ' . $operation);
        }
    }
}
function showKAModelOperation(){

}

function showKAModel($type, $id, $title, $formName, $btnTitle, $bodyHtml = ''){
    ?>
    <div id="modal" class="modal show" role="dialog">
        <div class="modal-dialog">
            <form method="post" action="<?php echo '?type=' . $type . '&selected=' . $id; ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" href="<?php echo '?type=' . $type; ?>"></a>
                        <h4 class="modal-title">
                            <?php
                            echo $title;
                            ?>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <?php
                        echo '<input type="hidden" name="formName" value="' . $formName . '">';
                        //--TODO body

                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="" class="btn btn-primary"><?php echo $btnTitle; ?></button>
                        <a class="btn btn-default" href="?type=$type">Abbrechen</a>
                    </div>
            </form>
        </div>
    </div>
    </div>
    <?php
}
function showModelBody($operation, $type, $id){

}
function showModelAttribute(){

}

function showAttributes($k_id){
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
                        echo '<td><a class="btn btn-primary" href="?operation=edit&type=Attribut&id='.$data[A_ID].'">'
                            .'<span class=\"glyphicon glyphicon-pencil\"></span></a></td>';
                        echo '<td><a class="btn btn-danger" href="?operation=delete&type=Attribut&id='.$data[A_ID].'">'
                            .'<span class=\"glyphicon glyphicon-remove\"></span></a></td>';
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