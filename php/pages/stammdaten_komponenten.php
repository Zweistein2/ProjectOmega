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
    <link rel="stylesheet" type="text/css" href="../../css/frameworks/datatables.min.css"/>
    <script type="text/javascript" src="../../js/frameworks/datatables.js"></script>
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
            function hrefGen() {
                global $type;
                $href = "";
                if ($type == "hardware") {
                    $href = "verwaltung_neuanlage.php";
                } else {
                    $href = "?type=$type&operation=new";
                }
                echo "<a class='btn btn-primary' href='$href'>Neuen Datensatz anlegen</a>";
            }

            echo hrefGen();
            ?>
            <button class="btn btn-info" data-toggle="collapse" href="#collapse1">Weitere Spalten anzeigen</button>

            <div id="collapse1" class="panel-collapse collapse">
                <div class="panel-body">
                <?php
                $columnText = getColumnText($type, false, true);
                $counter = 0;

                foreach ($columnText as $i) {
                    echo "<div class=\"col col-xs-3\"><a class=\"toggle-vis\" data-column=\"".$counter."\">".$i."</a></div>";
                    $counter++;
                }
                ?>
                </div>
            </div>
            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col col-xs-6">
                        </div>
                        <div class="col col-xs-6">
                            <h3 class="panel-title" id="panelTitle"></h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-list" id="table" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <?php
                            $columnNames = getColumnNames($type, false, true);
                            $idColumn = getIDColumn($type);
                            $nameColumn = getNameColumn($type);
                            foreach ($columnText as $i) {
                                echo "<th>$i</th>";
                            }
                            ?>
                            <th><span class="glyphicon glyphicon-edit"></span></th><!--Ändern -->
                            <?php
                            if ($type != "users") {
                               echo "<th><span class=\"glyphicon glyphicon-copy\"></span></th>";
                            }
                            ?>
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
                                $highlighter = "class=\"selected\"";
                            }
                            echo "<tr $highlighter>";
                            foreach ($columnNames as $i) {
                                echo '<td>' . $result[$i] . '</td>';
                            }
                            echo "<td><a class=\"btn btn-primary\" href=\"?operation=edit&type=$type&id=$id&name=$name\"><span class=\"glyphicon glyphicon-pencil\"></span></a></td>";
                            if ($type != "users") {
                                echo "<td><a class=\"btn btn-warning\" href=\"?operation=copy&type=$type&id=$id&name=$name\"><span class=\"glyphicon glyphicon-copy\"></span></a></td>";
                            }
                            echo "<td><a class=\"btn btn-danger\" href=\"?operation=delete&type=$type&id=$id&name=$name\"><span class=\"glyphicon glyphicon-remove\"></span></a></td>";
                            echo '</tr>';

                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>


<script>
    $(document).ready(function() {

        var table = $('#table').DataTable({
            "pagingType": "full",
            "oLanguage": {
                "sEmptyTable": "Keine Einträge vorhanden",
                "sInfo": "Zeige Einträge _START_ bis _END_ (von _TOTAL_)",
                "sInfoEmpty": "Keine Einträge vorhanden",
                "sInfoFiltered": " - gefiltert aus _MAX_ Einträgen",
                "sLengthMenu": "Zeige _MENU_ Einträge",
                "sLoadingRecords": "Einträge werden geladen...",
                "sProcessing": "Tabelle ist derzeit beschäftigt",
                "sSearch": "Filtere Einträge nach:",
                "sZeroRecords": "Keine Einträge vorhanden",
                "oPaginate": {
                    "sFirst": "<<",
                    "sLast": ">>",
                    "sNext": ">",
                    "sPrevious": "<"
                }
            },
            "lengthMenu": [[8],[8]],
            "bLengthChange": false,
            "columnDefs": [
                {
                    "targets": [0, 1, 2, 3],
                    visible: true
                },
                {
                    "width": "5%",
                    "bSortable": false,
                    "searchable": false,
                    visible: true,
                    "targets": -1
                },
                {
                    "width": "5%",
                    "bSortable": false,
                    "searchable": false,
                    visible: true,
                    "targets": -2
                },
                {
                    "width": "5%",
                    "bSortable": false,
                    "searchable": false,
                    visible: true,
                    "targets": -3
                },
                {
                    targets: '_all',
                    visible: false
                }
            ]
        });

        $('a.toggle-vis').on( 'click', function (e) {
            e.preventDefault();

            //Auswählen der entsprechenden Spalte
            var column = table.column( $(this).attr('data-column') );

            //Sichtbar/Unsichtbar
            column.visible( ! column.visible() );
        } );
    });
</script>