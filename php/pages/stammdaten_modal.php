<?php

if (isset($_GET["operation"]) && isset($_GET["type"]) && isset($_GET["id"])) {
    $operation = $_GET["operation"];
    $type = $_GET["type"];
    $id = $_GET["id"];
    $htmlOutput = "";

    if ($operation == "delete") {
        $htmlOutput = deleteEntry($type, $id);
    }
    if ($operation == "edit") {
        $htmlOutput = editEntry($type, $id);
    }

    echo $htmlOutput;
}

function generateDiag($title, $btnTitle, $message, $href)
{
    $modalHtml = "<div id=\"modal\" class=\"modal show\" role=\"dialog\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <a class=\"close\" href='?'>&times;</a>
                <h4 class=\"modal-title\">$title</h4>
            </div>
            <div class=\"modal-body\">
                <p>$message</p>
            </div>
            <div class=\"modal-footer\">
                <a href=\"$href\" class=\"btn btn-primary\">$btnTitle</a>
                <a href='' class=\"btn btn-default\">Abbrechen</a>
            </div>
        </div>

    </div>
</div>";

    return $modalHtml;

}

function deleteEntry($type, $id)
{
    global $dbAlias;
    $returnHtml = "";
    if (isset($dbAlias[$type])) {
        $title = "Eintrag löschen";
        $message = "Möchten Sie den den Eintrag " . $id . " wirklich löschen?";
        $btnTitle = "Löschen";
        $href = "#";
        $returnHtml = generateDiag($title, $btnTitle, $message, $href);
    }
    return $returnHtml;
}

function changeEntry()
{

}

?>