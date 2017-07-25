<?php

if (isset($_GET["operation"])) {
    $operation = $_GET["operation"];
    $htmlOutput = "";
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        if ($operation == "delete") {
            $htmlOutput = deleteEntry($id);
        }
        if ($operation == "edit") {
            $htmlOutput = editEntry($id);
        }
    }
    if ($operation == "new") {
        $htmlOutput = newEntry();
    }

    echo $htmlOutput;
}

function generateDiag($title, $btnTitle, $html, $href)
{
    global $type;
    $modalHtml = "<div id=\"modal\" class=\"modal show\" role=\"dialog\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <a class=\"close\" href=\"?type=$type\">&times;</a>
                <h4 class=\"modal-title\">$title</h4>
            </div>
            <div class=\"modal-body\">
                $html
            </div>
            <div class=\"modal-footer\">
                <a href=\"$href\" class=\"btn btn-primary\">$btnTitle</a>
                <a class=\"btn btn-default\" href=\"?type=$type\">Abbrechen</a>
            </div>
        </div>

    </div>
</div>";

    return $modalHtml;

}

function deleteEntry($id)
{
    $returnHtml = "";
    $title = "Eintrag löschen";
    $html = "Möchten Sie den den Eintrag " . $id . " wirklich löschen?";
    $btnTitle = "Löschen";
    $href = "#";
    $returnHtml = generateDiag($title, $btnTitle, $html, $href);
    return $returnHtml;
}

function editEntry($id)
{
    global $type;
    global $dbElements;
    $rowNames = $dbElements[$type];
    $title = "Ändern";
    $html = "";
    $btnTitle = "Speichern";
    $href = "#";
    $query = getOneByTableAndID($type, $id);
    foreach ($rowNames as $i) {
        $html = $html . "<p>$i:<input type='text' name='$i' value='$query[$i]'</p>";
    }
    return generateDiag($title, $btnTitle, $html, $href);
}

function newEntry()
{
    global $type;
    global $dbElements;
    $rowNames = $dbElements[$type];
    $title = "Neu";
    $html = "";
    $btnTitle = "Speichern";
    $href = "#";
    $query = getEntriesByTable($type);
    foreach ($rowNames as $i) {
        $html = $html . "<p>$i:<input type='text' name='$i'</p>";
    }
    return generateDiag($title, $btnTitle, $html, $href);
}

?>