<!--
 * Created by PhpStorm.
 * Author: Fabian Karolat
 * Date: 26.07.2017
 * Time: 13:53
 -->

<?php
require_once("../authentication/auth_filter.php");
checkForMinAccess("Lehrer");
?>

<html>
    <head>
        <title>Reporting</title>
        <?php
            include_once("../template/head.template.php");
            require_once('../database/reporting_sql.php');
            require_once('../database/database.php');
        ?>
        <link href="../../css/reporting.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../../css/frameworks/datatables.min.css"/>
        <script type="text/javascript" src="../../js/frameworks/datatables.js"></script>
    </head>
    <body>
        <script type='text/javascript'>
        </script>
        <?php include_once("../template/sidebar.template.php"); ?>
        <div class="container">
            <h2>Reporting</h2>
            <div class="row">
                <div class="col-md-3">
                    <select class="selectpicker" id="typeSelect" data-style="btn-info">
                        <?php
                        //Auslesen aller vorhandenen Hardware-Typen für das Dropdown-Element
                        $result = getFilledHardwareTypesForReporting();
                        var_dump($result);

                            foreach($result as $array)
                            {
                                foreach($array as $value)
                                {
                                    echo "<option>".$value."</option>";
                                }
                            }
                        ?>
                        <option>Raum</option>
                    </select>
                    <form action="#">
                        <div class="form-group invisible" id="form">
                            <label for="roomNumber">Raumnummer:</label>
                            <input type="text" class="form-control" id="roomNumber" value="001" onchange="changeRoomNumber()">
                        </div>
                    </form>
                </div>
                <div class="col-md-7">
                    <div class="panel panel-default panel-table">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col col-xs-12">
                                    <h3 class="panel-title" id="panelTitle">Räume mit PC</h3>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-list" id="table">
                                <tbody>
                                    <script>
                                        $('.selectpicker').change(function(){
                                            var inputValue = $(this).val();
                                            if(inputValue == "Raum")
                                            {
                                                $(table.column(0).header()).html("Typ");
                                                $(table.column(1).header()).html("Name");
                                                $(table.column(2).header()).html("Bezeichner");

                                                var roomNumber = $('#roomNumber').val();
                                                $('#form').toggleClass("invisible", false);
                                                $('#panelTitle').html("Ausstattung von Raum " + roomNumber);

                                                //Ajax um die PHP-Funktion aufzurufen
                                                $.post('../functions/reporting_table.php', { dropdownValue: "Raum", roomNumber: roomNumber }, function(data){
                                                    table.ajax.reload();
                                                });
                                            }else
                                            {
                                                $(table.column(0).header()).html("Raumnummer");
                                                $(table.column(1).header()).html("Raumbezeichner");
                                                $(table.column(2).header()).html("Notiz");

                                                $('#form').toggleClass("invisible", true);
                                                $('#panelTitle').html("Räume mit " + inputValue);

                                                //Ajax um die PHP-Funktion aufzurufen
                                                $.post('../functions/reporting_table.php', { dropdownValue: inputValue }, function(data){
                                                    table.ajax.reload();
                                                });
                                            }
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
                                            "ajax": "../functions/reporting_table.php",
                                            "bLengthChange": false,
                                            columns: [
                                                { title: "Raumnummer" },
                                                { title: "Raumbezeichner" },
                                                { title: "Notiz" }
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
<script>
    $('.selectpicker').val("PC");

    $.post('../functions/reporting_table.php', { dropdownValue: "PC" }, function(data){
        table.ajax.reload();
    });

    function changeRoomNumber() {
        var roomNumber = $('#roomNumber').val();
        $('#form').toggleClass("invisible", false);
        $('#panelTitle').html("Ausstattung von Raum " + roomNumber);

        //Ajax um die PHP-Funktion aufzurufen
        $.post('../functions/reporting_table.php', { dropdownValue: "Raum", roomNumber: roomNumber }, function(data){
            table.ajax.reload();
        });
    }
</script>