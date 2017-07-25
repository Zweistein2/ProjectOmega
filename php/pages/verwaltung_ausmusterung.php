<html>
<head>
    <title>Verwaltung - Ausmusterung</title>
    <?php include("../template/head.template.php");
    include("../functions/verwaltung_PHPfunction.php"); ?>
    <link href="../../css/verwaltung.css" rel="stylesheet">
    <script type='text/javascript' src="../../js/verwaltung_JSfunction.js"></script>
</head>
<body>

<?php include("../template/sidebar.template.php"); ?>
<div class="container">
    <h2>Verwaltung - Ausmusterung</h2>
    <div class="row">
        <div class="col-md-3">
            <select class="selectpicker" data-style="btn-info">

                <!--                <option -->
                <?php //if($_GET["art"] == "pc"){echo " selected ";} ?><!--value="verwaltung_ausmusterung.php?art=pc">PC</option>-->
                <!--                <option -->
                <?php //if($_GET["art"] == "switch"){echo " selected ";} ?><!-- value="verwaltung_ausmusterung.php?art=switch">Switch</option>-->
                <!--                <option -->
                <?php //if($_GET["art"] == "router"){echo " selected ";} ?><!--value="verwaltung_ausmusterung.php?art=router">Router</option>-->
                <!--                <option -->
                <?php //if($_GET["art"] == "drucker"){echo " selected ";} ?><!--value="verwaltung_ausmusterung.php?art=drucker">Drucker</option>-->
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
                            <button type="submit" class="btn btn-danger">Ausmustern</button>
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