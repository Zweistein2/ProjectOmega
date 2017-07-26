<!--
 * Created by PhpStorm.
 * Author: Fabian Karolat
 * Date: 26.07.2017
 * Time: 14:42
 -->
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
                    <select class="selectpicker col-sm-12 mt-6" data-style="btn-info">
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
                        <input type="number" class="form-control" id="amount">
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
                            <input type="text" class="form-control" id="Raum">
                        </div>
                        <div class="form-group">
                            <label for="Warranty">Gewährleistungsdauer:</label>
                            <input type="text" class="form-control" id="Warranty">
                        </div>
                        <div class="form-group">
                            <label for="Kaufbeleg">Kaufbeleg:</label>
                            <input type="text" class="form-control" id="Kaufbeleg">
                        </div>
                        <div class="form-group">
                            <label for="Lieferant">Lieferant:</label>
                            <input type="text" class="form-control" id="Lieferant">
                        </div>
                        <div class="form-group">
                            <label for="Notiz">Notiz:</label>
                            <input type="text" class="form-control" id="Notiz">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php
                        //Auslesen aller vorhandenen Hardware-Typen für das Dropdown-Element
                        $result = getHardwareAttributesByType("PC");

                        foreach($result as $array)
                        {
                            foreach($array as $value)
                            {
                                echo "<div class=\"form-group\">";
                                echo "<label for=\"".$value."\">".$value.":</label>";
                                echo "<input type=\"text\" class=\"form-control\" id=\"".$value."\">";
                                echo "</div>";
                            }
                        }
                        ?>
                    </div>
                    <!-- TODO: Modal für Menge -->
                    <button type="reset" class="btn btn-danger">Abbrechen</button>
                    <button type="submit" class="btn btn-success">Bestätigen</button>
                </form>
            </div>
        </div>
    </body>
</html>
