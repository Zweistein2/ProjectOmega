<html>
    <head>
        <title>Eintrag bearbeiten</title>
        <?php include("../template/head.template.php"); ?>
    </head>
    <body>
        <?php include("../template/sidebar.template.php"); ?>
        <div class="container">
            <h2>Eintrag bearbeiten - Raum R001</h2>
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>Raum Nummer: <input id="r_nr"></p>
                    <p>Raum Bezeichung: <input id="r_bezeichung"></p>
                    <p>Raum Notiz: <input id="r_notiz"></p>
                </div>
                <div class="panel-footer"><a href="#" class="btn btn-danger">Löschen</a>&nbsp;&nbsp;<a href="#"
                                                                                                       class="btn btn-primary">Abbrechen</a>
                </div>
            </div>
        </div>
    </body>
</html>

<!-- TODO: Refactoring! -->