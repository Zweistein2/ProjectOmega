<html>
<head>
    <title>Verwaltung - Ausmusterung</title>
    <?php include("../template/head.template.php");
    include("../functions/verwaltung_PHPfunction.php")
    ?>
    <link href="../../css/verwaltung.css" rel="stylesheet">
    <link href="" rel="script">
    <script type='text/javascript' src="../../js/verwaltung_JSfunction.js"/>


</head>
<body>
<script type='text/javascript'>

</script>
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
                            <th>Seriennummer</th>
                            <th>Bezeichnung</th>
                            <th>Raum</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>


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
                                <li id="firstPage"><a href="#"><<</a></li>
                                <li id="prev"><a href="#"><</a></li>
                                <li id="pageCounter" class="active"><a href="#">1</a></li>
                                <li id="next"><a href="#">></a></li>
                                <li id="lastPage"><a href="#">>></a></li>
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
<script>Init();</script>