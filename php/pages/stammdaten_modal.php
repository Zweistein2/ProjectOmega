<?php

if (isset($_GET["operation"]) && isset($_GET["id"])) {
    $operation = $_GET["operation"];
    $id = $_GET["id"];
    $htmlOutput = "";

    if ($operation == "delete") {
        $htmlOutput = deleteEntry($id);
    }
    if ($operation == "edit") {
        $htmlOutput = editEntry($id);
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
    global $dbAlias;
    global $type;
    $returnHtml = "";
    $title = "Eintrag löschen";
    $html = "Möchten Sie den den Eintrag " . $id . " wirklich löschen?";
    $btnTitle = "Löschen";
    $href = "#";
    $returnHtml = generateDiag($title, $btnTitle, $html, $href);
    return $returnHtml;
}

function editEntry()
{

}

?>