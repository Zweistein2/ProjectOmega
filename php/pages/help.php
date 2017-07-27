<!--
 * Created by PhpStorm.
 * Author: Fabian Karolat
 * Date: 26.07.2017
 * Time: 8:24
 -->

<?php
require_once("../authentication/auth_filter.php");
checkForMinAccess("Lehrer");
?>

<html>
    <head>
        <title>Hilfeseite</title>
        <?php
        include_once("../template/head.template.php");
        ?>
    </head>
    <body>
        <?php include_once("../template/sidebar.template.php"); ?>
        <div class="container">
            <h2>Hilfeseite</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <p>Brauchen sie Hilfe?</p>
                        </div>
                        <div class="panel-body">
                            <p>hier werden sie geholfen!</p>
                        </div>
                        <div class="panel-footer">
                            <p>Fußzeile.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="jumbotron">
                        <h1>Wir brauchen Hilfe!</h1>
                        <p>weil wir keinen Käsetoast mehr haben</p>
                        <p><a class="btn btn-primary btn-lg" href="#" role="button">#BlamePaulus</a></p>
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Warning!</strong> Better check yourself, you're not looking too good.
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