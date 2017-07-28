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
    <style>
        .faq-cat-content {
            margin-top: 25px;
        }

        .faq-cat-tabs li a {
            padding: 15px 10px 15px 10px;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            color: #777777;
        }

        .nav-tabs li a:focus,
        .panel-heading a:focus {
            outline: none;
        }

        .panel-heading a,
        .panel-heading a:hover,
        .panel-heading a:focus {
            text-decoration: none;
            color: #777777;
        }

        .faq-cat-content .panel-heading:hover {
            background-color: #efefef;
        }

        .active-faq {
            border-left: 5px solid #888888;
        }

        .panel-faq .panel-heading .panel-title span {
            font-size: 13px;
            font-weight: normal;
        }
    </style>
</head>
<body>
<?php include_once("../template/sidebar.template.php"); ?>
<div class="container">
    <div class="container" style="margin-top: 20px; ">
        <div class="row">
            <div class="col-md-10">
                <!-- Nav tabs category -->
                <ul class="nav nav-tabs faq-cat-tabs">
                    <?php if (strcmp(getUserGroupSession(), "Lehrer") !== 0) { ?>
                        <li class="active"><a href="#faq-cat-1" data-toggle="tab">Stammdaten</a></li>
                        <li><a href="#faq-cat-2" data-toggle="tab">Verwaltung</a></li>
                        <li><a href="#faq-cat-3" data-toggle="tab">Reporting</a></li>
                    <?php } else {?>
                        <li class="active"><a href="#faq-cat-3" data-toggle="tab">Reporting</a></li>
                    <?php } ?>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content faq-cat-content">
                    <!-- stammdaten -->
                    <div class="tab-pane <?php if (strcmp(getUserGroupSession(), "Lehrer") !== 0) { ?> active in fade<?php } ?>" id="faq-cat-1">
                        <div class="panel-group" id="accordion-cat-1">
                            <div class="panel panel-default panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion-cat-1" href="#faq-cat-1-sub-1">
                                        <h4 class="panel-title">
                                            Stammdaten - Komponenten
                                            <span class="pull-right"><i class="glyphicon glyphicon-plus"></i></span>
                                        </h4>
                                    </a>
                                </div>
                                <div id="faq-cat-1-sub-1" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Klickt man auf "Neuen Datensatz anlegen" öffnet sich ein kleines Popup-Fenster, in welchem man die entsprechenden Daten
                                            eintragen kann. (bei Hardware leitet auf die Verwaltung - Neuanlage weiter. Dort kann man dann über das entsprechende
                                            Formular neue Hardwarekomponenten anlegen).</p>
                                        <p>Klickt man auf Ändern, Kopieren oder Löschen (dargestellt durch die jeweiligen Symbole), so wird man dazu aufgefordert
                                            die Aktion zu bestätigen. Ist dies getan, wird diese durchgeführt.</p>
                                        <p>Klickt man auf "Weitere Spalten anzeigen", so hat man die Möglichkeit, Spalten ein- und auszublenden, damit die Tabelle
                                            nicht zu groß wird. Klickt man auf einen Namen, dessen Spalte unsichtbar ist, so wird diese sichtbar (und vice-versa).</p>
                                        <p>Die Tabelle lässt sich durchsuchen und nach den Spalten auf- oder absteigend sortieren. Desweiteren sind die Tabellen
                                            paginiert, so wird immer eine begrenzte Anzahl an Datensätzen angezeigt, mit den Buttons unten rechts an der Tabelle kann
                                            man bequem zwischen den einzelnen Seiten umschalten, links stehen die aktuellen Datensätze (und deren Gesamtzahl).</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion-cat-1" href="#faq-cat-1-sub-2">
                                        <h4 class="panel-title">
                                            Stammdaten - Komponentenarten
                                            <span class="pull-right"><i class="glyphicon glyphicon-plus"></i></span>
                                        </h4>
                                    </a>
                                </div>
                                <div id="faq-cat-1-sub-2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Klickt man auf "Neuen Datensatz anlegen" öffnet sich ein kleines Popup-Fenster, in welchem man die entsprechenden Daten
                                            eintragen kann.</p>
                                        <p>Klickt man auf Anzeigen, Ändern oder Löschen (dargestellt durch die jeweiligen Symbole), so wird man dazu aufgefordert
                                            die Aktion zu bestätigen. Ist dies getan, wird diese durchgeführt. Anzeigen zeigt die Attribute zu der jeweiligen
                                            Hardwareart an.</p>
                                        <p>Die Tabelle lässt sich durchsuchen und nach den Spalten auf- oder absteigend sortieren. Desweiteren sind die Tabellen
                                            paginiert, so wird immer eine begrenzte Anzahl an Datensätzen angezeigt, mit den Buttons unten rechts an der Tabelle kann
                                            man bequem zwischen den einzelnen Seiten umschalten, links stehen die aktuellen Datensätze (und deren Gesamtzahl).</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- verwaltung -->
                    <div class="tab-pane fade" id="faq-cat-2">
                        <div class="panel-group" id="accordion-cat-2">
                            <div class="panel panel-default panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion-cat-2" href="#faq-cat-2-sub-1">
                                        <h4 class="panel-title">
                                            Verwaltung - Neuanlage -> Wie lege ich Komponenten neu an?
                                            <span class="pull-right"><i class="glyphicon glyphicon-plus"></i></span>
                                        </h4>
                                    </a>
                                </div>
                                <div id="faq-cat-2-sub-1" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p><strong>Schritt 1:</strong> Auswahl einer Geräteart</p>
                                        <p><strong>Schritt 2:</strong> OPTIONAL: Menge angeben, falls mehrere Komponenten diesselben techn. Daten</p>
                                        <p><strong>Schritt 3:</strong> Auf den Button <em> „Anlegen“</em> klicken</p>
                                        <p><strong>Schritt 4:</strong> Evtl. Seriennummern nachtragen und bestätigen</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion-cat-2" href="#faq-cat-2-sub-2">
                                        <h4 class="panel-title">
                                            Verwaltung - Ausmusterung -> Wie mustert man Komponenten aus?
                                            <span class="pull-right"><i class="glyphicon glyphicon-plus"></i></span>
                                        </h4>
                                    </a>
                                </div>
                                <div id="faq-cat-2-sub-2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p><strong>Schritt 1:</strong> Auswahl einer Geräteart</p>
                                        <p><strong>Schritt 2:</strong> Alle Geräte auswählen die ausgemustert werden sollen</p>
                                        <p><strong>Schritt 3:</strong> Auf den Button <em> „Ausmustern“</em> klicken</p>
                                        <p><strong>Schritt 4:</strong> Ausmustern bestätigen</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- reporting -->
                    <div class="tab-pane  <?php if (strcmp(getUserGroupSession(), "Lehrer") == 0) { ?> active in fade<?php } else {?>fade<?php } ?>" id="faq-cat-3">
                        <div class="panel-group" id="accordion-cat-3">
                            <div class="panel panel-default panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion-cat-3" href="#faq-cat-3-sub-1">
                                        <h4 class="panel-title">
                                            Reporting
                                            <span class="pull-right"><i class="glyphicon glyphicon-plus"></i></span>
                                        </h4>
                                    </a>
                                </div>
                                <div id="faq-cat-3-sub-1" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Hier erhält man eine Übersicht über alle Räume, die gewisse Hardware beinhalten, bzw. kann sich zu einem
                                            bestimmten Raum die Ausstattung anzeigen lassen.</p>
                                        <p>Um nach einem Raum mit Geräten zu suchen, wählt man die entsprechende Geräteart im Dropdownmenü aus, die Tabelle
                                            aktualisiert sich daraufhin automatisch.</p>
                                        <p>Will man wissen, welche Ausstattung in einem Raum vorhanden ist, wählt man im Dropdownmenü "Raum" aus und
                                            gibt in dem erschienenen Input-Feld die Raumnummer ein. Danach wird mit einem Klick der Enter-Taste bestätigt
                                            und die Tabelle aktualisiert sich wieder von selbst.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div></div>
<script>
    $(document).ready(function() {
        $('.collapse').on('show.bs.collapse', function() {
            var id = $(this).attr('id');
            $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-faq');
            $('a[href="#' + id + '"] .panel-title span').html('<i class="glyphicon glyphicon-minus"></i>');
        });
        $('.collapse').on('hide.bs.collapse', function() {
            var id = $(this).attr('id');
            $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-faq');
            $('a[href="#' + id + '"] .panel-title span').html('<i class="glyphicon glyphicon-plus"></i>');
        });
    });
</script>
</body>
</html>
