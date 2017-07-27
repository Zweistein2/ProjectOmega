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
                            echo '<option value="'.$array[0].'">'.$array[1].'</option>';
                        }
                        ?>
                        <option value="-1">Software</option>
                    </select>
                    <div class="form-group col-sm-12 mt-6">
                        <label for="amount">Menge:</label>
                        <input type="number" class="form-control" min="1" value="1" name="amount" id="amount">
                    </div>
                </div>
                <form class="col-md-8" id="AjaxForm">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Hersteller">Hersteller:</label>
                            <input type="text" class="form-control" name="Hersteller">
                        </div>
                        <div class="form-group">
                            <label for="Einkaufsdatum">Einkaufsdatum:</label>
                            <input type="date" class="form-control" name="Einkaufsdatum" placeholder="yyyy-mm-dd">
                        </div>
                        <div class="form-group">
                            <label for="Name">Name:</label>
                            <input type="text" class="form-control" name="Name">
                        </div>
                        <div class="form-group">
                            <label for="Bezeichnung">Bezeichnung:</label>
                            <input type="text" class="form-control" name="Bezeichnung">
                        </div>
                        <div class="form-group" id="RaumSelect">
                            <label for="Raum">Raum:</label>
                            <select class="selectpicker" data-style="btn-default" name="Raum">
                                <?php
                                //Auslesen aller vorhandenen Räume für das Dropdown-Element
                                $result = getRoomsForVerwaltung();

                                foreach($result as $array)
                                {
                                    echo '<option value="'.$array[0].'">'.$array[1].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group" id="Warranty">
                            <label for="Warranty">Gewährleistungsdauer:</label>
                            <input type="text" class="form-control" name="Warranty">
                        </div>
                        <div class="form-group" id="LieferantSelect">
                            <label for="Lieferant">Lieferant:</label>
                            <select class="selectpicker" data-style="btn-default" name="Lieferant">
                                <?php
                                //Auslesen aller vorhandenen Lieferanten für das Dropdown-Element
                                $result = getSuppliersForVerwaltung();

                                foreach($result as $array)
                                {
                                    echo '<option value="'.$array[0].'">'.$array[1].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Notiz">Notiz:</label>
                            <input type="text" class="form-control" name="Notiz">
                        </div>
                        <div class="form-group">
                            <input type="text" class="hidden form-control" id="Type" name="Type" value="1">
                        </div>
                        <div class="form-group">
                            <input type="text" class="hidden form-control" id="Amount" name="Amount" value="1">
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
        if(inputValue == "-1")
        {
            $('#Warranty').toggleClass("hidden", true);
            $('#LieferantSelect').toggleClass("hidden", true);
            $('#Type').val("-1");
        }else
        {
            $('#Warranty').toggleClass("hidden", false);
            $('#LieferantSelect').toggleClass("hidden", false);
            $('#Type').val(inputValue);
        }

        //Ajax um die PHP-Funktion aufzurufen
        $.post('../functions/verwaltung_attributes.php', { dropdownValue: inputValue }, function(data){
            $('#attributes').html(data);
        });
    });

    var inputValue = 1;
    $('#amount').change(function(){
        inputValue = $(this).val();
        $('#Amount').val(inputValue);

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
    });

    $('#save').click(function(){
        var htmlstring = "<div class=\"form-group\">";
        for(var i = 1; i <= inputValue; i++)
        {
            htmlstring += "<label for=\"" + i + "\">Seriennummer " + i + ":</label><input type=\"text\" class=\"form-control\" id=\"" + i + "\" name=\"" + i + "\">";
        }
        htmlstring += "</div>";

        if(inputValue > 1) {
            var modal = $('#warningModal');
            modal.modal();
            modal.find('.modal-title').text('Fehlende Daten eintragen');
            modal.find('.modal-body').html(htmlstring);

            $('#saveButton').click(function(){
                //TODO: FIX Mehrere Seriennummern mitübergeben
                //Absenden
                $.post('../functions/verwaltung_insert.php', $('#AjaxForm').serialize(), function(data){
                    console.log(data);
                });

                $('#closeButton').click();
            });
        }else {
            //Absenden
            $.post('../functions/verwaltung_insert.php', $('#AjaxForm').serialize(), function(data){
                console.log(data);
            });
        }
    });

    $(document).ready(function(){
        //Ajax um die PHP-Funktion aufzurufen
        $.post('../functions/verwaltung_attributes.php', { dropdownValue: "1" }, function(response){
            $('#attributes').html(response);
        });
    });
</script>
