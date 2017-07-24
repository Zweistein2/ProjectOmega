<?php ?>

<html>
    <head>
        <title>Verwaltung - Neuanlage</title>
        <?php include("template/head.template.php"); ?>
        <link href="../css/verwaltung.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <h2>Verwaltung - Neuanlage</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Wähle eine Komponentenart
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">PCs</a></li>
                            <li><a href="#">Switches</a></li>
                            <li><a href="#">Router</a></li>
                        </ul>
                    </div>
                    <div class="form-group col-sm-12 mt-6">
                        <label for="amount">Menge:</label>
                        <input type="number" class="form-control" id="amount">
                    </div>
                </div>
                <div class="col-md-8">
                    <form>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="CPU">CPU:</label>
                            <input type="text" class="form-control" id="CPU">
                        </div>
                        <div class="form-group">
                            <label for="RAM">RAM:</label>
                            <input type="text" class="form-control" id="RAM">
                        </div>
                        <button type="reset" class="btn btn-danger">Abbrechen</button>
                        <button type="submit" class="btn btn-success">Bestätigen</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
