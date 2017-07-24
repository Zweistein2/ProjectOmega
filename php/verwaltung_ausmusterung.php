<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">


<html>
<div style="margin-top: 40px"></div>
<div class="col-sm-2">Hier kommt die Sidebar</div>
<div class="col-sm-2">

    <select style="height: 30px; width: 120px">
        <option>PC</option>
        <option>Switch</option>
        <option>Router</option>
        <option>Drucker</option>
    </select>
</div>

<div class="col-sm-6">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>CPU</th>
            <th>RAM</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php

            $string = "<tr>
            <td>1</td>
            <td>I7 4770</td>
            <td>4 GB</td>
            <td style='text-align: center'><input type='checkbox'></td>
        </tr>";
        echo $string;
        echo $string;
        echo $string;
        echo $string;
        echo $string;
        echo $string;


     ?>
        </tbody>
    </table>
    <div class="col-sm-6"><button>Ausmustern</button></div>
    <div class="col-sm-6"  style="text-align: right">
        <ul class="pagination" style="margin-top: 0px">
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
        </ul>
    </div>




</div>




</html>