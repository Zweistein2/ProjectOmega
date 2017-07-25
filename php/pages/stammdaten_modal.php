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

if (isset($_POST["formName"])) {
    $formName = $_POST["formName"];

    if ($formName == "newEntry") {
        $data = $_POST;
        unset($data["formName"]);
        $data = excludeIdRow($data);
        insertIntoTable($type, $data);
    }

}

function generateDiag($formName, $title, $btnTitle, $html, $href)
{
    global $type;
    $modalHtml = "<div id=\"modal\" class=\"modal show\" role=\"dialog\">
    <div class=\"modal-dialog\">
    <form method=\"post\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <a class=\"close\" href=\"?type=$type\">&times;</a>
                <h4 class=\"modal-title\">$title</h4>
            </div>
            <div class=\"modal-body\">
                <input type=\"hidden\" name=\"formName\" value=\"$formName\">
                $html
            </div>
            <div class=\"modal-footer\">
                <button type=\"submit\" name=\"\" class=\"btn btn-primary\">$btnTitle</button>
                <a class=\"btn btn-default\" href=\"?type=$type\">Abbrechen</a>
            </div>
            </form>
        </div>
    </div>
</div>";

    return $modalHtml;

}

function deleteEntry($id)
{
    $returnHtml = "";
    $formName = "deleteEntry";
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
    $formName = "editEntry";
    $html = "";
    $btnTitle = "Speichern";
    $href = "#";
    $query = getOneByTableAndID($type, $id);
    foreach ($rowNames as $i) {
        $html = $html . "<p>$i:<input type='text' name='$i' value='$query[$i]'</p>";
    }
    return generateDiag($formName, $title, $btnTitle, $html, $href);
}

function newEntry()
{
    global $type;
    global $dbElements;
    $rowNames = excludeIdRow($dbElements[$type]);
    $formName = "newEntry";
    $title = "Neu";
    $html = "";
    $btnTitle = "Speichern";
    $href = "#";
    $query = getEntriesByTable($type);
    foreach ($rowNames as $i) {
        $html = $html . "<p>$i:<input type='text' name='$i'</p>";
    }
    return generateDiag($formName, $title, $btnTitle, $html, $href);
}

?>