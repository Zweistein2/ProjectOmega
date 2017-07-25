<html>
    <head>
        <title>Stammdaten</title>
        <?php
        include("../template/head.template.php");
        include("stammdaten.php");
        ?>
        <link href="../../css/stammdaten.css" rel="stylesheet">
    </head>
    <body>
        <?php include("../template/sidebar.template.php"); ?>
        <div class="container">
            <h2>Stammdaten</h2>
            <div class="row">
                <div class="col col-md-10">
                    <button type="submit" class="btn btn-primary">Neuen Datensatz anlegen</button>
                    <div class="panel panel-default panel-table">
                        <div class="panel-body">
                            <table class="table table-striped table-list">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Raum</th>
                                        <th>Lieferant</th>
                                        <th>Einkaufsdatum</th>
                                        <th>Gewährleistungsdauer</th>
                                        <th>Notiz</th>
                                        <th>Hersteller</th>
                                        <th>Komponentenart</th>
                                        <th><span class="glyphicon glyphicon-edit"></span></th><!--Ändern -->
                                        <th><span class="glyphicon glyphicon-copy"></span></th><!--Copy -->
                                        <th><span class="glyphicon glyphicon-remove"></span></th><!--Löschen -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //--todo: testdaten

                                    $result = array();
                                    $result[] = array();
                                    $result[] = array();

                                    $result[0]['k_id'] = 1;
                                    $result[0]['raeume_r_id'] = 1;
                                    $result[0]['lieferant_l_id'] = 1;
                                    $result[0]['k_einkaufsdatum'] = '2017-07-07';
                                    $result[0]['k_gewaehrleistungsdauer'] = 20;
                                    $result[0]['k_notiz'] = '';
                                    $result[0]['k_hersteller'] = 'ABC';
                                    $result[0]['komponentenarten_ka_id'] = 1;

                                    $result[1]['k_id'] = 2;
                                    $result[1]['raeume_r_id'] = 1;
                                    $result[1]['lieferant_l_id'] = 1;
                                    $result[1]['k_einkaufsdatum'] = '2017-06-22';
                                    $result[1]['k_gewaehrleistungsdauer'] = 20;
                                    $result[1]['k_notiz'] = '';
                                    $result[1]['k_hersteller'] = 'ABC';
                                    $result[1]['komponentenarten_ka_id'] = 1;

                                    //--todo: testdaten ende

                                    //while($data = mysqli_fetch_assoc($result)){ //TODO: result
                                    foreach($result as $data){
                                        echo '<tr>';
                                        echo '<td>'.$data['k_id'].'</td>';
                                        echo '<td>'.$data['raeume_r_id'].'</td>'; //TODO: Raumnummer
                                        echo '<td>'.$data['lieferant_l_id'].'</td>'; //TODO: Lieferantenname
                                        echo '<td>'.$data['k_einkaufsdatum'].'</td>';
                                        echo '<td>'.$data['k_gewaehrleistungsdauer'].'</td>';
                                        echo '<td>'.$data['k_notiz'].'</td>';
                                        echo '<td>'.$data['k_hersteller'].'</td>';
                                        echo '<td>'.$data['komponentenarten_ka_id'].'</td>'; //TODO: Name der Komponentenart
                                        echo '<td><a class="btn btn-primary" href="?operation=edit&type=raeume&id=' . $data['k_id'] . '"><span class="glyphicon glyphicon-pencil"></span></a></td>';
                                        echo '<td><a class="btn btn-warning" href="?operation=copy&type=raeume&id=' . $data['k_id'] . '"><span class="glyphicon glyphicon-copy"></span></a></td>';
                                        echo '<td><a class="btn btn-danger" href="?operation=delete&type=raeume&id=' . $data['k_id'] . '"><span class="glyphicon glyphicon-remove"></span></a></td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col col-xs-4"></div>
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

        <div id="StammdatenAendern" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Ändern</h4>
                    </div>
                    <div class="modal-body">
                        <p>Wirklich ändern?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                        <button type="submit" class="btn btn-success">Löschen</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="StammdatenCopy" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Copy</h4>
                    </div>
                    <div class="modal-body">
                        <p>Wirklich kopieren?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                        <button type="submit" class="btn btn-success">Löschen</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="StammdatenLoeschen" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Loeschen</h4>
                    </div>
                    <div class="modal-body">
                        <p>Wirklich löschen?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                        <button type="submit" class="btn btn-success">Löschen</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<!-- TODO: Refactoring! -->