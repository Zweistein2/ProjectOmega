<html>
<head>
    <title>Stammdaten</title>
    <?php include("template/head.template.php"); ?>
</head>
<body>
<div class="container">
    <div class="row" style="margin-bottom:30px;">
        <button class="btn btn-primary">Neu</button>
    </div>
    <div class="row">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Raumnummer</th>
                <th>Bezeichnung</th>
                <th>Beschreibung</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>R002</td>
                <td>Besprechungsraum Erdgeschoss</td>
                <td></td>
                <td>
                    <a href="#" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="#" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                    <a href="#" class="btn btn-warning"><span class="glyphicon glyphicon glyphicon-copy"></span></a>
                </td>
            </tr>
            <tr>
                <td>R102</td>
                <td>Besprechungsraum erster Stock</td>
                <td></td>
                <td>
                    <a href="#" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="#" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                    <a href="#" class="btn btn-warning"><span class="glyphicon glyphicon glyphicon-copy"></span></a>
                </td>
            </tr>
            <tr>
                <td>R101</td>
                <td>Computerraum erster Stock</td>
                <td></td>
                <td>
                    <a href="#" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="#" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                    <a href="#" class="btn btn-warning"><span class="glyphicon glyphicon glyphicon-copy"></span></a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="row pull-right">
        <button class="btn btn-primary"><span class="glyphicon glyphicon-menu-left"></span></button>
        <input type="text" id="pageIndex" style="width:30px;text-align: center;" value="1">
        <button class="btn btn-primary"><span class="glyphicon glyphicon-menu-right"></span></button>
    </div>
</div>
</body>
</html>

<?php
?>