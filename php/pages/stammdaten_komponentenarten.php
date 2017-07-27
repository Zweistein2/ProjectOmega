<?php
require_once("../authentication/auth_filter.php");
checkForMinAccess("Admin");
?>

<html>
<head>
    <title>Stammdaten</title>
    <?php include("../template/head.template.php"); ?>
    <link href="../../css/stammdaten.css" rel="stylesheet">
</head>
<body>
<?php include("../template/sidebar.template.php"); ?>
<div class="container">
    <h2>Stammdaten</h2>
    <div class="row">
        <div class="col col-md-5">
            <div class="panel panel-default panel-table">
                <div class="panel-body">
                    <table class="table table-striped table-list">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Art</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        //TODO: Testdaten löschen
                        $result = array();
                        $result[] = array();
                        $result[] = array();

                        $result[0]['ka_id'] = 1;
                        $result[0]['ka_komponentenart'] = 'PC';
                        $result[1]['ka_id'] = 2;
                        $result[1]['ka_komponentenart'] = 'Switch';

                        foreach($result as $data){
                        //while($data = mysqli_fetch_assoc($result)){
                            echo '<tr>';
                            echo '<td>'.$data['ka_id'].'</td>';
                            echo '<td>'.$data['ka_komponentenart'].'</td>';
                            echo '<td><input type="submit" name="del_art_'.$data['ka_id'].'" value="Attribute"/></td>';
                            echo '<td><input type="submit" name="update_art_'.$data['ka_id'].'" value="Attribute"/></td>';
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
        <div class="col col-md-5">
            <div class="panel panel-default panel-table">
                <div class="panel-body">
                    <table class="table table-striped table-list">
                        <thead>
                        <?php

                        /*
                        foreach($_POST as $key => $value){
                            $arr = explode('_', $key);
                            if($arr[0] == 'update'){
                                $art_id = $arr[2];
                        */

                        echo '<tr>';
                        echo '<th>ID</th>';
                        echo '<th>Bezeichnung</th>';
                        echo '<th></th>';
                        echo '</tr>';
                        echo '</thead>';

                        echo '<tbody>';
                        //TODO: Attribute nach ArtID
                        $result_art = array();
                        $result_art[] = array();
                        $result_art[] = array();

                        $result_art[0]['kat_id'] = 1;
                        $result_art[0]['kat_bezeichnung'] = 'CPU';
                        $result_art[1]['kat_id'] = 2;
                        $result_art[1]['kat_bezeichnung'] = 'RAM';

                        foreach($result_art as $attr){
                            //while($attr = mysqli_fetch_assoc($result_art)){
                            echo '<tr>';
                            echo '<td>'.$attr['kat_id'].'</td>';
                            echo '<td>'.$attr['kat_bezeichnung'].'</td>';
                            echo '<td><input type="submit" name="del_attr_'.$attr['kat_id'].'" value="x"/></td>';
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
    </div>
</body>
</html>

<!-- TODO: Refactoring! -->