<!--
 * Created by PhpStorm.
 * Author: Fabian Karolat
 * Date: 26.07.2017
 * Time: 14:42
 -->

<?php
require_once("../authentication/auth_filter.php");
checkForMinAccess("Admin");
?>

<html>
    <head>
        <title>Verwaltung - Neuanlage</title>
        <?php include_once("../template/head.template.php");
        require_once('../database/verwaltung_sql.php');
        require_once('../database/database.php'); ?>
        <link href="../../css/verwaltung.css" rel="stylesheet">
    </head>
    <body>
        <?php include_once("../template/sidebar.template.php"); ?>
        <div class="container">
            <h2>Verwaltung - Neuanlage</h2>
            <div class="row">
                <div class="col-md-2">
                    <select class="selectpicker col-sm-12 mt-6" id="typePicker" data-style="btn-info">
                        <?php
                        //Auslesen aller vorhandenen Hardware-Typen für das Dropdown-Element
                        $result = getHardwareTypes();
                        foreach($result as $array)
                        {
                            foreach($array as $value)
                            {
                                echo "<option>".$value."</option>";
                            }
                        }
                        ?>
                    </select>
                    <div class="form-group col-sm-12 mt-6">
                        <label for="amount">Menge:</label>
                        <input type="number" class="form-control" min="0" id="amount">
                    </div>
                </div>
                <form class="col-md-8">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Hersteller">Hersteller:</label>
                            <input type="text" class="form-control" id="Hersteller">
                        </div>
                        <div class="form-group">
                            <label for="Bezeichnung">Bezeichnung:</label>
                            <input type="text" class="form-control" id="Bezeichnung">
                        </div>
                        <div class="form-group">
                            <label for="Raum">Raum:</label>
                            <select class="selectpicker" data-style="btn-default form-control" id="Raum">
                                <?php
                                //Auslesen aller vorhandenen Räume für das Dropdown-Element
                                $result = getRoomsForVerwaltung();

                                foreach($result as $array)
                                {
                                    foreach($array as $value)
                                    {
                                        echo "<option>".$value."</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Warranty">Gewährleistungsdauer:</label>
                            <input type="text" class="form-control" id="Warranty">
                        </div>
                        <div class="form-group">
                            <label for="Lieferant">Lieferant:</label>
                            <select class="selectpicker" data-style="btn-default form-control" id="Lieferant">
                                <?php
                                //Auslesen aller vorhandenen Lieferanten für das Dropdown-Element
                                $result = getSuppliersForVerwaltung();

                                foreach($result as $array)
                                {
                                    foreach($array as $value)
                                    {
                                        echo "<option>".$value."</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Notiz">Notiz:</label>
                            <input type="text" class="form-control" id="Notiz">
                        </div>
                    </div>
                    <div class="col-md-6" id="attributes">
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="reset" class="btn btn-danger">Abbrechen</button>
                            <button type="button" class="btn btn-success" id="save">Anlegen</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"  id="closeButton">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">title</h4>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Abbrechen</button>
                        <button type="button" class="btn btn-success" id="saveButton">Anlegen</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<script>
    $('#typePicker').change(function(){
        var inputValue = $(this).val();

        //Ajax um die PHP-Funktion aufzurufen
        $.post('../functions/verwaltung_attributes.php', { dropdownValue: inputValue }, function(data){
            $('#attributes').html(data);
        });
    });

    $('#amount').change(function(){
        var inputValue = $(this).val();

        if(inputValue > 1) {
            var seriennummer = $('#Seriennummer');
            if (seriennummer != null) {
                seriennummer.prop("disabled", true);
            }
        }else {
            var seriennummer = $('#Seriennummer');
            if (seriennummer != null) {
                seriennummer.prop("disabled", false);
            }
        }

        $('#save').click(function(){
            var htmlstring = "<div class=\"form-group\">";
            for(var i = 1; i <= inputValue; i++)
            {
                htmlstring += "<label for=\"" + i + "\">Seriennummer " + i + ":</label><input type=\"text\" class=\"form-control\" id=\"" + i + "\">";
            }
            htmlstring += "</div>";

            if(inputValue > 1) {
                var modal = $('#warningModal');
                modal.modal();
                modal.find('.modal-title').text('Fehlende Daten eintragen');
                modal.find('.modal-body').html(htmlstring);

                $('#saveButton').click(function(){
                    //Absenden
                    //Ajax um die PHP-Funktion aufzurufen
                    $.post('../functions/verwaltung_insert.php', { dropdownValue: inputValue }, function(data){
                        $('#attributes').html(data);
                    });

                    $('#closeButton').click();
                });
            }else {
                //Absenden?
            }
        });
    });

    $(document).ready(function(){
        //Ajax um die PHP-Funktion aufzurufen
        $.post('../functions/verwaltung_attributes.php', { dropdownValue: "PC" }, function(response){
            $('#attributes').html(response);
        });
    });
</script>
