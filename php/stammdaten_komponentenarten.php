<?php
/**
 * Created by PhpStorm.
 * User: mkern
 * Date: 24.07.2017
 * Time: 12:54
 */
?>
<div style="float:left;clear:both;border-right:1px solid black">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Art</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        //TODO: Testdaten löschen
        $result = array();
        $result[] = array();
        $result[] = array();

        $result[0]['ka_id'] = 1;
        $result[0]['ka_komponentenart'] = 'PC';
        $result[1]['ka_id'] = 2;
        $result[1]['ka_komponentenart'] = 'Switch';

        foreach($result as $data){
        //while($data = mysqli_fetch_assoc($result)){
            echo '<tr>';
            echo '<td>'.$data['ka_id'].'</td>';
            echo '<td>'.$data['ka_komponentenart'].'</td>';
            echo '<td><input type="submit" name="del_art_'.$data['ka_id'].'" value="Attribute"/></td>';
            echo '<td><input type="submit" name="update_art_'.$data['ka_id'].'" value="Attribute"/></td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
    <input type="submit" name="add_art" value="Neu"/>
</div>

<div style="float:left">
    <?php

    /*
    foreach($_POST as $key => $value){
        $arr = explode('_', $key);
        if($arr[0] == 'update'){
            $art_id = $arr[2];
    */

            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Bezeichnung</th>';
            echo '<th></th>';
            echo '</tr>';
            echo '</thead>';

            echo '<tbody>';
            //TODO: Attribute nach ArtID
            $result_art = array();
            $result_art[] = array();
            $result_art[] = array();

            $result_art[0]['kat_id'] = 1;
            $result_art[0]['kat_bezeichnung'] = 'CPU';
            $result_art[1]['kat_id'] = 2;
            $result_art[1]['kat_bezeichnung'] = 'RAM';

            foreach($result_art as $attr){
            //while($attr = mysqli_fetch_assoc($result_art)){
                echo '<tr>';
                echo '<td>'.$attr['kat_id'].'</td>';
                echo '<td>'.$attr['kat_bezeichnung'].'</td>';
                echo '<td><input type="submit" name="del_attr_'.$attr['kat_id'].'" value="x"/></td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            /*
        }
    }
            */
    ?>
</div>