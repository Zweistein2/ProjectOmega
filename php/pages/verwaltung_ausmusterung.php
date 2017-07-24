<html>
    <head>
        <title>Verwaltung - Ausmusterung</title>
        <?php include("../template/head.template.php"); ?>
        <link href="../../css/verwaltung.css" rel="stylesheet">
    </head>
    <body>
        <?php include("../template/sidebar.template.php"); ?>
        <div class="container">
            <h2>Verwaltung - Ausmusterung</h2>
            <div class="row">
                <div class="col-md-3">
                    <select class="selectpicker" data-style="btn-info">
                        <option>PC</option>
                        <option>Switch</option>
                        <option>Router</option>
                        <option>Drucker</option>
                    </select>
                </div>
                <div class="col-md-7">
                    <div class="panel panel-default panel-table">
                        <div class="panel-body">
                            <table class="table table-striped table-list">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Hersteller</th>
                                        <th>CPU</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>HorstBox</td>
                                        <td>Dell</td>
                                        <td>i5-4460</td>
                                        <td>
                                            <div class="checkbox">
                                                <input type="checkbox" value="">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>HorstBox 2</td>
                                        <td>Dell</td>
                                        <td>i7-6400</td>
                                        <td>
                                            <div class="checkbox">
                                                <input type="checkbox" value="">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dell Gaming RGB 9000</td>
                                        <td>Dell</td>
                                        <td>i7-7700K</td>
                                        <td>
                                            <div class="checkbox">
                                                <input type="checkbox" value="">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Acer Aspire</td>
                                        <td>Acer</td>
                                        <td>i5-4460</td>
                                        <td>
                                            <div class="checkbox">
                                                <input type="checkbox" value="">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col col-xs-4">
                                    <button type="submit" class="btn btn-danger">Löschen</button>
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
    </body>
</html>