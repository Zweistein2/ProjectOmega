<html>
    <head>
        <title>Reporting</title>
        <?php include("../template/head.template.php"); ?>
        <?php include("../functions/reporting_PHPfunction.php"); ?>
        <link href="../../css/reporting.css" rel="stylesheet">
        <script type='text/javascript' src="../../js/reporting_JSfunction.js"></script>
    </head>
    <body>
        <script type='text/javascript'>
        </script>
        <?php include("../template/sidebar.template.php"); ?>
        <div class="container">
            <h2>Reporting</h2>
            <div class="row">
                <div class="col-md-3">
                    <select class="selectpicker" data-style="btn-info">
                        <?php
                            $result = getHardwareTypes();

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
                    <div>
                        <div class="list-group">
                            <button type="button" class="list-group-item" data-toggle="modal" data-target="#AusstattungModal">nach Ausstattung...</button>
                            <button type="button" class="list-group-item">nach Komponentenattribute...</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="panel panel-default panel-table">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col col-xs-12">
                                    <h3 class="panel-title">Komponenten gefiltert nach Komponentenattribute: Art = PC; Hersteller = Dell, Acer</h3>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-list">
                                <thead>
                                    <td>Raumnummer</td>
                                    <td>Raumbezeichnung</td>
                                    <td>Notiz</td>
                                </thead>
                                <tbody>
                                <?php
                                    $result = getRoomsByComponentType("PC");
                                    foreach($result as $array)
                                    {
                                        echo "<tr>";
                                        foreach($array as $value)
                                        {
                                            echo "<td>".$value."</td>";
                                        }
                                        echo "</tr>";
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col col-xs-4"></div>
                                <div class="col col-xs-8">
                                    <ul class="pagination hidden-xs pull-right">
                                        <li class="" id="firstPage"><a href="#"><<</a></li>
                                        <li class="" id="backward"><a href="#"><</a></li>
                                        <li class="active" id="currentPage"><a href="#">3</a></li>
                                        <li class="" id="forward"><a href="#">></a></li>
                                        <li class="" id="lastPage"><a href="#">>></a></li>
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
<script>
    Init();
</script>