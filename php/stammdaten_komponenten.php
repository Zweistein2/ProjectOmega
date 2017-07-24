<?php
/**
 * Created by PhpStorm.
 * User: mkern
 * Date: 24.07.2017
 * Time: 12:09
 */
?>
<input type="submit" name="add_komp" value="Neu"/>
<br>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Raum</th>
            <th>Lieferant</th>
            <th>Einkaufsdatum</th>
            <th>Gewährleistungsdauer</th>
            <th>Notiz</th>
            <th>Hersteller</th>
            <th>Komponentenart</th>
            <th></th><!--Löschen -->
            <th></th><!--Ändern -->
            <th></th><!--Copy -->
        </tr>
    </thead>
    <tbody>
        <?php
        //--todo: testdaten

        $result = array();
        $result[] = array();
        $result[] = array();

        $result[0]['k_id'] = 1;
        $result[0]['raeume_r_id'] = 1;
        $result[0]['lieferant_l_id'] = 1;
        $result[0]['k_einkaufsdatum'] = '2017-07-07';
        $result[0]['k_gewaehrleistungsdauer'] = 20;
        $result[0]['k_notiz'] = '';
        $result[0]['k_hersteller'] = 'ABC';
        $result[0]['komponentenarten_ka_id'] = 1;

        $result[1]['k_id'] = 2;
        $result[1]['raeume_r_id'] = 1;
        $result[1]['lieferant_l_id'] = 1;
        $result[1]['k_einkaufsdatum'] = '2017-06-22';
        $result[1]['k_gewaehrleistungsdauer'] = 20;
        $result[1]['k_notiz'] = '';
        $result[1]['k_hersteller'] = 'ABC';
        $result[1]['komponentenarten_ka_id'] = 1;

        //--todo: testdaten ende


        //while($data = mysqli_fetch_assoc($result)){ //TODO: result
        foreach($result as $data){
            echo '<tr>';
            echo '<td>'.$data['k_id'].'</td>';
            echo '<td>'.$data['raeume_r_id'].'</td>'; //TODO: Raumnummer
            echo '<td>'.$data['lieferant_l_id'].'</td>'; //TODO: Lieferantenname
            echo '<td>'.$data['k_einkaufsdatum'].'</td>';
            echo '<td>'.$data['k_gewaehrleistungsdauer'].'</td>';
            echo '<td>'.$data['k_notiz'].'</td>';
            echo '<td>'.$data['k_hersteller'].'</td>';
            echo '<td>'.$data['komponentenarten_ka_id'].'</td>'; //TODO: Name der Komponentenart
            echo '<td><input type="submit" name="del_komp_'.$data['k_id'].'" value="Löschen"/></td>';
            echo '<td><input type="submit" name="update_komp_'.$data['k_id'].'" value="Ändern"/></td>';
            echo '<td><input type="submit" name="copy_komp_'.$data['k_id'].'" value="Kopieren"/></td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>

