<html>
<head>
    <title>Verwaltung - Ausmusterung</title>
    <?php
    include_once("../template/head.template.php");
    require_once('../database/verwaltung_sql.php');
    require_once('../database/database.php');
    ?>
    <link href="../../css/verwaltung.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/frameworks/datatables.min.css"/>
    <script type="text/javascript" src="../../js/frameworks/datatables.js"></script>
</head>
<body>
<?php include("../template/sidebar.template.php"); ?>
<div class="container">
    <h2>Verwaltung - Ausmusterung</h2>
    <div class="row">
        <div class="col-md-3">
            <select class="selectpicker" data-style="btn-info">
                <?php
                //Auslesen aller vorhandenen Hardware-Typen für das Dropdown-Element
                $result = getHardwareTypes();

                foreach ($result as $array) {
                    foreach ($array as $value) {
                        echo "<option>" . $value . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-md-7">
            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col col-xs-6">
                            <button type="submit" class="btn btn-danger" id="soft-delete">Ausmustern</button>
                        </div>
                        <div class="col col-xs-6">
                            <h3 class="panel-title" id="panelTitle"></h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-list" id="table">
                        <tbody>
                        <script>
                            $('.selectpicker').change(function () {
                                var inputValue = $(this).val();

                                //Ajax um die PHP-Funktion aufzurufen
                                $.post('../functions/verwaltung_table.php', {dropdownValue: inputValue}, function (data) {
                                    table.ajax.reload();
                                });
                            });

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
                                "ajax": "../functions/verwaltung_table.php",
                                "bLengthChange": false,
                                columns: [
                                    {title: "Seriennummer"},
                                    {title: "Bezeichnung"},
                                    {title: "Raum"},
                                    {title: "ID"}
                                ]
                            });
                        </script>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<!-- TODO: Modal für Warnhinweis zwecks Ausmusterung -->

<script>
    $(document).ready(function () {
        table.column(3).visible(false);

        $('#table tbody').on('click', 'tr', function () {
            $(this).toggleClass('selected');
        });

        $('#soft-delete').click(function () {
            var count = table.rows('.selected').data().length;
            var indexes = table.rows('.selected').indexes();
            var ids = "";

            for (var i = 0; i < count; i++) {
                ids += table.row(indexes[i]).data()[3];
                if (i != count - 1) {
                    ids += ",";
                }
            }

            var idArray = JSON.stringify(ids);

            $.post('../functions/verwaltung_delete.php', {ids: idArray}, function (data) {
                table.ajax.reload();
            });
        });
    });
</script>