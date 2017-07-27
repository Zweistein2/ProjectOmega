<?php
require_once("../authentication/auth_filter.php");
checkForMinAccess("Admin");
?>


<html>
<head>
    <title>Stammdaten</title>
    <?php
    include("../template/head.template.php");
    require("stammdaten.php");
    ?>
    <link href="../../css/stammdaten.css" rel="stylesheet">
</head>
<body>
<?php include("../template/sidebar.template.php"); ?>
<div class="container">
    <?php
    $typeName = getTypeName($type, true);
    echo "<h2>$typeName</h2>";
    ?>
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
                            $columnText = getColumnText($type, false, true);
                            $columnNames = getColumnNames($type, false, true);
                            $idColumn = getIDColumn($type);
                            $nameColumn = getNameColumn($type);
                            foreach ($columnText as $i) {
                                echo "<th>$i</th>";
                            }
                            ?>
                            <th><span class="glyphicon glyphicon-edit"></span></th><!--Ändern -->
                            <th><span class="glyphicon glyphicon-copy"></span></th><!--Copy -->
                            <th><span class="glyphicon glyphicon-remove"></span></th><!--Löschen -->
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $selected = "";
                        $query = getQuery($type);
                        if (isset($_GET["selected"])) {
                            $selected = $_GET["selected"];
                        }
                        while ($result = mysqli_fetch_assoc($query)) {
                            $highlighter = "";
                            $id = $result[$idColumn];
                            $name = $result[$nameColumn];
                            if ($selected == $id) {
                                $highlighter = "style=\"background-color:#00FF00;\"";
                            }
                            echo "<tr $highlighter>";
                            foreach ($columnNames as $i) {
                                echo '<td>' . $result[$i] . '</td>';
                            }
                            echo "<td><a class=\"btn btn-primary\" href=\"?operation=edit&type=$type&id=$id&name=$name\"><span class=\"glyphicon glyphicon-pencil\"></span></a></td>";
                            echo "<td><a class=\"btn btn-warning\" href=\"?operation=copy&type=$type&id=$id&name=$name\"><span class=\"glyphicon glyphicon-copy\"></span></a></td>";
                            echo "<td><a class=\"btn btn-danger\" href=\"?operation=delete&type=$type&id=$id&name=$name\"><span class=\"glyphicon glyphicon-remove\"></span></a></td>";
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