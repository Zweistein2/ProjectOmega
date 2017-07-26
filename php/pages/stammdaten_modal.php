<?php

/**
 * @checkTriggerPoints: Prüfen ob eines der TriggerPoints gesetzt wurde um eine Operation in die Wege zu leiten.
 * Prüft ob der GET-Parameter 'operation' gesetzt wurde um die Funktion 'modalOperation' zu triggern
 * und dessen Ausgabe wiederzugeben.
 * Prüft ob der POST-Parameter 'formName' gesetzt wurde um die Funktion 'executeOperation' zu triggern.
 * Achtung: Muss in der PHP-Datei aufgerufen werden!
 */

function checkTriggerPoints()
{
    if (isset($_GET["operation"])) {
        $operation = $_GET["operation"];
        $output = modalOperation($operation);
        echo $output;
    }
    if (isset($_POST["formName"])) {
        $formName = $_POST["formName"];
        executeOperation($formName);
    }
}

checkTriggerPoints();

/**
 * @modalOperation: Modal für eine Operation erzeugen
 * Sollte eine Operation (Erstellen, Ändern, Löschen oder Kopieren) ausgewählt sein,
 * wird diese mit dem GET-Parameter 'operation' übergeben und über eine If-Schleife
 * an die entsprechenden Funktion weitergeleitet, welche dann ein passendes Modal erzeugt.
 * Parameter formName: Bestimmt die entsprechende Operation (newEntry, editEntry, copyEntry, deleteEntry)
 * Ausgabe: Reines html des erzeugten Modals
 */

function modalOperation($operation)
{
    $htmlOutput = "";
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        if ($operation == "delete") {
            $htmlOutput = deleteEntry($id);
        }
        if ($operation == "edit") {
            $htmlOutput = editEntry($id);
        }
        if ($operation == "copy") {
            $htmlOutput = copyEntry($id);
        }
    }
    if ($operation == "new") {
        $htmlOutput = newEntry();
    }

    return $htmlOutput;
}

/**
 * @executeOperation: Operation durchführen
 * Nachdem eine Operation ausgewählt, mögliche Änderungen über das generierte Modal
 * vorgenommen und abgeschickt wurden, kommen diese per POST zurück und werden
 * an die entsprechende SQL-Funktion übergeben.
 * Parameter formName: bestimmt die entsprechende Operation (newEntry, editEntry, deleteEntry)
 *                     Achtung: Operation copyEntry wird nicht in executeOperation vorgenommen, da kein Modal notwendig
 */

function executeOperation($formName)
{
    global $type;
    if ($formName == "newEntry") {
        $data = $_POST;
        unset($data["formName"]);
        $data = excludeIdColumn($data);
        insertIntoTable($type, $data);
    }

    if ($formName == "deleteEntry") {
        $id = $_POST["id"];
        deleteEntryByTableAndID($type, $id);
    }
}

/**
 * @generateModal: Zentrale Funktion zum Erzeugen eines Modals
 * Das Modal enthält eine Post-Form und bekommt über den html Parameter die entsprechenden Inputs oder Text
 * Parameter formName: Bestimmt die Operation(newEntry, editEntry, deleteEntry) für die Funktion executeOperation
 *                     Achtung: Operation copyEntry wird nicht in executeOperation vorgenommen, da kein Modal notwendig
 * Parameter title: Bestimmt den Titel für das Modal
 * Parameter btnTitle: Bestimmt Text für den Submit-Button
 * Parameter html: Übergabe eines Textes oder Inputs
 * Ausgabe: Das gesamte Modal in html
 */

function generateModal($formName, $title, $btnTitle, $html)
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

/**
 * @deleteEntry: Setzt passende Parameter für die Funktion 'generateModal',
 *               wenn ein Datensatz gelöscht werden soll.
 * Ausgabe: Reines html des generierten Modals
 */

function deleteEntry($id)
{
    $returnHtml = "";
    $formName = "deleteEntry";
    $title = "Eintrag löschen";
    $html = "<p>Möchten Sie den den Eintrag " . $id . " wirklich löschen?</p>";
    $btnTitle = "Löschen";
    $returnHtml = generateModal($formName, $title, $btnTitle, $html);
    return $returnHtml;
}

/**
 * @copyEntry: Führt eine SQL-Operation durch,
 *               wenn ein Datensatz dupliziert werden soll.
 *               Achtung: Eine Ausnahme da beim Kopieren kein Modal erscheinen soll.
 * Ausgabe: Reines html einer Erfolgsmeldung
 */

function copyEntry($id)
{

}

/**
 * @editEntry: Setzt passende Parameter für die Funktion 'generateModal',
 *           wenn ein Datensatz geändert werden soll.
 * Ausgabe: Reines html des generierten Modals
 */

function editEntry($id)
{
    global $type;
    global $dbElements;
    global $dbElementsTranslator;
    $rowNames = excludeIdColumn($dbElements[$type]);
    $translate = excludeIdColumn($dbElementsTranslator[$type]);
    $title = "Eintrag ändern";
    $formName = "editEntry";
    $html = "";
    $btnTitle = "Speichern";
    $query = getOneByTableAndID($type, $id);

    for ($i = 0; $i < sizeof($rowNames); $i++) {
        $rowName = $rowNames[$i];
        $modalText = $translate[$i];
        $html = $html . "<p>$modalText<input type='text' name='$rowName' value='$query[$rowName]'</p>";
    }

    return generateModal($formName, $title, $btnTitle, $html);
}

/**
 * @newEntry: Setzt passende Parameter für die Funktion 'generateModal',
 *            wenn ein Datensatz erstellt werden soll.
 * Ausgabe: Reines html des generierten Modals
 */

function newEntry()
{
    global $type;
    global $dbElements;
    global $dbElementsTranslator;
    $rowNames = excludeIdColumn($dbElements[$type]);
    $translate = excludeIdColumn($dbElementsTranslator[$type]);
    $formName = "newEntry";
    $title = "Neuer Eintrag";
    $html = "";
    $btnTitle = "Speichern";

    for ($i = 0; $i < sizeof($rowNames); $i++) {
        $rowName = $rowNames[$i];
        $modalText = $translate[$i];
        $html = $html . "<p>$modalText:<input type='text' name='$rowName'</p>";
    }

    return generateModal($formName, $title, $btnTitle, $html);
}

?>