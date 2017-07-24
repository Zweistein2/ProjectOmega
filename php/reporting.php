<html>
    <head>
        <title>Reporting</title>
        <?php include("template/head.template.php"); ?>
        <link href="../css/reporting.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <h2>Reporting</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Wähle die Stammdaten zum filtern
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Räume</a></li>
                            <li><a href="#">Lieferanten</a></li>
                            <li><a href="#">Komponenten</a></li>
                        </ul>
                    </div>
                    <div>
                        <div class="list-group">
                            <button type="button" class="list-group-item" data-toggle="modal" data-target="#AusstattungModal">nach Ausstattung...</button>
                            <button type="button" class="list-group-item">nach Komponentenattribute...</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default panel-table">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col col-xs-12">
                                    <h3 class="panel-title">PCs gefiltert nach Komponentenattribute: Hersteller = Dell, Acer</h3>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-list">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Hersteller</th>
                                        <th>CPU</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>HorstBox</td>
                                        <td>Dell</td>
                                        <td>i5-4460</td>
                                    </tr>
                                    <tr>
                                        <td>HorstBox 2</td>
                                        <td>Dell</td>
                                        <td>i7-6400</td>
                                    </tr>
                                    <tr>
                                        <td>Dell Gaming RGB 9000</td>
                                        <td>Dell</td>
                                        <td>i7-7700K</td>
                                    </tr>
                                    <tr>
                                        <td>Acer Aspire</td>
                                        <td>Acer</td>
                                        <td>i5-4460</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col col-xs-4">Page 3 of 5
                                </div>
                                <div class="col col-xs-8">
                                    <ul class="pagination hidden-xs pull-right">
                                        <li><a href="#"><<</a></li>
                                        <li><a href="#"><</a></li>
                                        <li class="active"><a href="#">3</a></li>
                                        <li><a href="#">></a></li>
                                        <li><a href="#">>></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="AusstattungModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Ausstattungsfilter</h4>
                    </div>
                    <div class="modal-body">
                        <ul class="list-unstyled">
                            <li>
                                <div class="checkbox">
                                    <label><input type="checkbox" value="">Option 1</label>
                                </div>
                            </li>
                            <li>
                                <div class="checkbox">
                                    <label><input type="checkbox" value="">Option 2</label>
                                </div>
                            </li>
                            <li>
                                <div class="checkbox">
                                    <label><input type="checkbox" value="">Option 3</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                        <button type="submit" class="btn btn-success">Filter anwenden</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>