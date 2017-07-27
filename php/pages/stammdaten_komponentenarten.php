<?php
require_once("../authentication/auth_filter.php");
checkForMinAccess("Admin");
?>

<html>
<head>
    <title>Stammdaten</title>
    <?php include_once("../template/head.template.php"); ?>
    <link href="../../css/stammdaten.css" rel="stylesheet">
    <link href="../../css/frameworks/datatables.min.css" rel="stylesheet" type="text/css"/>
    <script src="../../js/frameworks/datatables.js" type="text/javascript"></script>
</head>
<body>
<?php
include_once("../template/sidebar.template.php");
include_once("../database/stammdaten_sql.php");
include_once("stammdaten_modal.php");
if(!isset($_SESSION['selectedKindToShow'])){
    $_SESSION['selectedKindToShow'] = 0;
}
define("SD_KIND", 'Art');
define("SD_ATTR", 'Attribut');
$ka_titles = [
    'delete' => 'löschen',
    'edit' => 'ändern',
    'insert' => 'einfügen'
];
$ka_tables = [
    SD_KIND => HARDWARE_KINDS,
    SD_ATTR => ATTRIBUTES
]
?>
<div class="container">
    <h2>Stammdaten</h2>
    <!--<form method="post" action="stammdaten_komponentenarten.php"/>-->
    <div class="row">
        <div class="col col-md-5">
            <a class="btn btn-primar" href="?type=<?php echo SD_KIND;?>&operation=insert&id=0">Neuen Datensatz anlegen</a>
            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col col-xs-6">
                        </div>
                        <div class="col col-xs-6">
                            <h3 class="panel-title" id="panelTitle"></h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-list" id="tableArt" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <?php
                                $headers = ['ID' => K_ID, 'Hardware-Art' => K_NAME];
                                foreach($headers as $key => $val){
                                    echo '<th>'.$key.'</th>';
                                }
                                ?>
                                <th><span class="glyphicon glyphicon-menu-hamburger"></th> <!--Attribute-->
                                <th><span class="glyphicon glyphicon-edit"></span></th><!--Ändern -->
                                <th><span class="glyphicon glyphicon-remove"></span></th><!--Löschen -->
                            </tr>
                        </thead>
                        <tbody>
                        <?php

                        $result = getEntriesByTable(HARDWARE_KINDS);
                        while($data = mysqli_fetch_assoc($result)){
                            echo '<tr>';
                            foreach($headers as $val){
                                echo '<td>'.$data[$val].'</td>';
                            }
                            echo '<td><a class="btn btn-warning"'
                                .'href="?operation=showAttributes&type='.SD_KIND.'&id='.$data[K_ID].'">'
                                .'<span class="glyphicon glyphicon-pencil"></span></a></td>';
                            echo '<td><a class="btn btn-primary" '
                                .'href="?operation=edit&type='.SD_KIND.'&id='.$data[K_ID].'">'
                                .'<span class="glyphicon glyphicon-pencil"></span></a></td>';
                            echo '<td><a class="btn btn-danger" '
                                .'href="?operation=delete&type='.SD_KIND.'&id='.$data[K_ID].'">'
                                .'<span class="glyphicon glyphicon-remove"></span></a></td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
        checkKAModal();
        showAttributes($_SESSION['selectedKindToShow']);
        ?>
    </div>
</body>
</html>

<?php
function checkKAModal(){
    global $ka_titles;
    global $ka_tables;
    global $type;
    $type = isset($_GET["type"]) ? $_GET["type"] : SD_KIND;

    if (isset($_GET["operation"])){
        $operation = $_GET["operation"];
        if($operation == 'showAttributes'){
            $id = $_GET["id"];
            $_SESSION['selectedKindToShow'] = $id;
        }else if(!isset($_POST['formName'])){
            $id = isset($_GET["id"]) ? $_GET["id"] : 0;
            $formName = '';
            $body = '';
            $tabname = $ka_tables[$type];
            $one = getOneByTableAndID($tabname, $id);
            $btnTitle = "Speichern";
            if($operation == 'delete'){
                if($type == SD_KIND){
                    $body = '<input type="hidden" name="id" value="'.$one[K_ID].'">';
                    $body .= 'Wollen Sie wirklich die Hardware-Art "'.$one[K_NAME].'" (ID: '.$one[K_ID].') löschen?';
                }else if($type == SD_ATTR){
                    $body = '<input type="hidden" name="id" value="'.$one[A_ID].'">';
                    $body .= '<input type="hidden" name="ArtID" value="'.$_GET['ArtID'].'">';
                    $body .= 'Wollen Sie wirklich das Attribut "'.$one[A_DESC].'" (ID: '.$one[A_ID]
                        .') von dieser Hardware-Art entfernen?';
                }
                $formName = 'deleteKA';
                $btnTitle = 'Löschen';
            }else if($operation == 'edit'){
                if($type == SD_KIND){
                    $body = showModalAddEditKind($id, $one[K_NAME]);
                }else if($type == SD_ATTR){
                    $k_id = $_GET['ArtID'];
                    $body = showModalAddEditAttribute($k_id, $id, $one[A_DESC]);
                }
                $formName = 'editKA';
            }else if($operation == 'insert'){
                if($type == SD_KIND){
                    $body = showModalAddEditKind();
                }else if($type == SD_ATTR){
                    $body = showModalAddEditAttribute($id); //Art-ID wird als id übergeben
                }
                $formName = 'insertKA';
            }
            $title = $type.' '.$ka_titles[$operation];
            echo generateModal($formName, $title, $btnTitle, $body, $id);
        }
    }
    if(isset($_POST["formName"])){
        $formName = $_POST['formName'];
        executeKAOperation($formName, $type);
    }
}
function executeKAOperation($formName, $type){
    global $ka_tables;
    global $prims;
    $tabName = $ka_tables[$type];
    $id = isset($_POST['id']) ? $_POST['id']:0;
    switch($formName){
        case 'editKA':
            $data = array();
            $data[$prims[$tabName]] = $id;
            if($type == SD_KIND){
                $data[K_NAME] = $_POST['kind_name'];
                updateEntry($tabName, $data);
            }else if($type == SD_ATTR){
                $sel = $_POST['modal_kind_attributes'];
                $k_id = $_POST['ArtID'];
                if($sel == 0){
                    $data[A_DESC] = $_POST['attribute_name'];
                    updateEntry($tabName, $data);
                }else{
                    removeAttributeFromKind($k_id, $id);
                    addExistingAttributeToKind($k_id, $sel);
                }
            }
            break;
        case 'deleteKA':
            if($type == SD_ATTR){
                $k_id = $_POST['ArtID'];
                removeAttributeFromKind($k_id, $id);
            }else if(SD_KIND){
                deleteEntryByTableAndID($tabName, $id);
            }
            break;
        case 'insertKA':
            if($type == SD_KIND){
                $data = array();
                $data[K_ID] = $id;
                $data[K_NAME] = $_POST['kind_name'];
                $data[K_DELETED] = FLAG_UNDELETED;
                insertIntoTable(HARDWARE_KINDS, $data);
            }else if($type == SD_ATTR){
                $sel = $_POST['modal_kind_attributes'];
                $k_id = $_POST['ArtID'];
                if($sel == 0){
                    $desc = $_POST['attribute_name'];
                    addNewAttributeToKind($k_id, $desc);
                }else{
                    addExistingAttributeToKind($k_id, $sel);
                }
            }
            break;
        default:
            break;
    }
}

function showModalAddEditKind($k_id = 0, $name = ''){
    $html = '<input type="hidden" name="id" value="'.$k_id.'"/>';
    $html .= '<p>Name:</p>';
    $html .= '<input type="text" class="form-control" name="kind_name" value="'.$name.'"/>';
    return $html;
}
/**
 * Ändern oder einfügen eines Attributes in Beziehung zu einer Art
 * @param $k_id: ID der Art
 * @param string $a_desc: aktueller Name des Attributs
 * @return string
 */
function showModalAddEditAttribute($k_id, $a_id = 0, $a_desc = ''){
    $attr = getAttributesByKindID($k_id, true);
    $html = '';
    $html .= '<input type="hidden" name="ArtID" value="'.$k_id.'">';
    $html .= '<input type="hidden" name="id" value="'.$a_id.'">';
    $html .= '
            <select name="modal_kind_attributes">
                <option value="0">--Textfeld benutzen</option>';
    while($data = mysqli_fetch_assoc($attr)){
        $html .= '<option value="'.$data[A_ID].'">'.$data[A_DESC].'</option>';
    }
    $html .= '</select>
        <input type="text" class="form-control" name="attribute_name" value="'.$a_desc.'"/>';
    return $html;
}

function showAttributes($k_id){
    if($k_id == 0) return;
    ?>
    <div class="col col-md-5">
        <a class="btn btn-primar" href="?type=<?php echo SD_ATTR;?>&operation=insert&id=<?php echo $k_id?>">Neuen Datensatz anlegen</a>
        <div class="panel panel-default panel-table">
            <div class="panel-heading">
                <div class="row">
                    <div class="col col-xs-6">
                    </div>
                    <div class="col col-xs-6">
                        <h3 class="panel-title" id="panelTitle"></h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-list" id="tableAttribute" width="100%" cellspacing="0">
                    <thead>
                    <?php
                    echo '<tr>';
                    $attr_headers = ['ID' => A_ID, 'Bezeichnung' => A_DESC];
                    foreach($attr_headers as $key => $val){
                        echo '<th>'.$key.'</th>';
                    }
                    echo '<th><span class="glyphicon glyphicon-edit"></span></th>'; //--Ändern
                    echo '<th><span class="glyphicon glyphicon-remove"></span></th>'; //--Löschen
                    echo '</tr>';
                    echo '</thead>';

                    echo '<tbody>';
                    $result = getAttributesByKindID($k_id);
                    while($data = mysqli_fetch_assoc($result)){
                        echo '<tr>';
                        foreach($attr_headers as $key => $val){
                            echo '<td>'.$data[$val].'</td>';
                        }
                        echo '<td><a class="btn btn-primary" href="?operation=edit&type='.SD_ATTR.'&ArtID='.$k_id.'&id='.$data[A_ID].'">'
                            .'<span class=\"glyphicon glyphicon-pencil\"></span></a></td>';
                        echo '<td><a class="btn btn-danger" href="?operation=delete&type='.SD_ATTR.'&ArtID='.$k_id.'&id='.$data[A_ID].'">'
                            .'<span class=\"glyphicon glyphicon-remove\"></span></a></td>';
                        echo '</tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php } ?>

<script>
    $(document).ready(function() {
        var tableArt = $('#tableArt').DataTable({
            "pagingType": "full",
            "oLanguage": {
                "sEmptyTable": "Keine Einträge vorhanden",
                "sInfo": "Zeige Einträge _START_ bis _END_ (von _TOTAL_)",
                "sInfoEmpty": "Keine Einträge vorhanden",
                "sInfoFiltered": " - gefiltert aus _MAX_ Einträgen",
                "sLengthMenu": "Zeige _MENU_ Einträge",
                "sLoadingRecords": "Einträge werden geladen...",
                "sProcessing": "Tabelle ist derzeit beschäftigt",
                "sSearch": "Filtere Einträge nach:",
                "sZeroRecords": "Keine Einträge vorhanden",
                "oPaginate": {
                    "sFirst": "<<",
                    "sLast": ">>",
                    "sNext": ">",
                    "sPrevious": "<"
                }
            },
            "lengthMenu": [[8],[8]],
            "bLengthChange": false,
            "columnDefs": [
                {
                    "width": "5%",
                    "bSortable": false,
                    "searchable": false,
                    visible: true,
                    "targets": -1
                },
                {
                    "width": "5%",
                    "bSortable": false,
                    "searchable": false,
                    visible: true,
                    "targets": -2
                },
                {
                    "width": "5%",
                    "bSortable": false,
                    "searchable": false,
                    visible: true,
                    "targets": -3
                }
            ]
        });

        var tableAttr = $('#tableAttribute').DataTable({
            "pagingType": "full",
            "oLanguage": {
                "sEmptyTable": "Keine Einträge vorhanden",
                "sInfo": "Zeige Einträge _START_ bis _END_ (von _TOTAL_)",
                "sInfoEmpty": "Keine Einträge vorhanden",
                "sInfoFiltered": " - gefiltert aus _MAX_ Einträgen",
                "sLengthMenu": "Zeige _MENU_ Einträge",
                "sLoadingRecords": "Einträge werden geladen...",
                "sProcessing": "Tabelle ist derzeit beschäftigt",
                "sSearch": "Filtere Einträge nach:",
                "sZeroRecords": "Keine Einträge vorhanden",
                "oPaginate": {
                    "sFirst": "<<",
                    "sLast": ">>",
                    "sNext": ">",
                    "sPrevious": "<"
                }
            },
            "lengthMenu": [[8],[8]],
            "bLengthChange": false,
            "columnDefs": [
                {
                    "width": "5%",
                    "bSortable": false,
                    "searchable": false,
                    visible: true,
                    "targets": -1
                },
                {
                    "width": "5%",
                    "bSortable": false,
                    "searchable": false,
                    visible: true,
                    "targets": -2
                },
                {
                    "width": "5%",
                    "bSortable": false,
                    "searchable": false,
                    visible: true,
                    "targets": -3
                }
            ]
        });
    });
</script>