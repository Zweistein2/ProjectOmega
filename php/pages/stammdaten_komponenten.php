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
                    <?php
                    echo "<a class='btn btn-primary' href='?type=$type&operation=new'>Neuen Datensatz anlegen</a>";
                    ?>
                    <div class="panel panel-default panel-table">
                        <div class="panel-body">
                            <table class="table table-striped table-list">
                                <thead>
                                    <tr>
                                        <?php
                                        $rowNames = $dbElements[$type];
                                        foreach ($rowNames as $i) {
                                            echo "<th>$i</th>";
                                        }
                                        ?>
                                        <th><span class="glyphicon glyphicon-pencil"></span></th><!--Ändern -->
                                        <th><span class="glyphicon glyphicon-duplicate"></span></th><!--Copy -->
                                        <th><span class="glyphicon glyphicon-remove"></span></th><!--Löschen -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $query = getEntriesByTable($type);
                                    while ($result = mysqli_fetch_assoc($query)) { //TODO: result
                                        foreach ($rowNames as $i) {
                                            echo '<td>' . $result[$i] . '</td>';
                                        }
                                        echo '<td><a class="btn btn-primary" href="?operation=edit&type=' . $type . '&id=' . $result[$rowNames[0]] . '"><span class="glyphicon glyphicon-pencil"></span></a></td>';
                                        echo '<td><a class="btn btn-warning" href="?operation=copy&type=' . $type . '&id=' . $result[$rowNames[0]] . '"><span class="glyphicon glyphicon-duplicate"></span></a></td>';
                                        echo '<td><a class="btn btn-danger" href="?operation=delete&type=' . $type . '&id=' . $result[$rowNames[0]] . '"><span class="glyphicon glyphicon-remove"></span></a></td>';
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
    </body>
</html>

<!-- TODO: Refactoring! -->