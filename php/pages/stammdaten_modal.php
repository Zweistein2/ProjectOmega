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
    if (isset($_GET["id"]) && isset($_GET["name"])) {
        $id = $_GET["id"];
        $name = $_GET["name"];
        if ($operation == "delete") {
            $htmlOutput = deleteEntry($id, $name);
        }
        if ($operation == "edit") {
            $htmlOutput = editEntry($id, $name);
        }
        if ($operation == "copy") {
            $htmlOutput = copyEntry($id, $name);
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
        if ($type == "users") {
            createUser($_POST['username'], $_POST['PASSWORD'], $_POST[U_ROLES_ID]);
        } else {
            $data = $_POST;
            unset($data["formName"]);
            insertIntoTable($type, $data);
        }
    }

    if ($formName == "editEntry") {
        $data = $_POST;
        if ($type == "users") {
            updateUser($_POST['username'], $_POST['PASSWORD'], $_POST[U_ROLES_ID]);
        } else {
            unset($data["formName"]);
            updateEntry($type, $data);
        }
    }

    if ($formName == "deleteEntry") {
        $id = $_POST["id"];
        if ($type == "users") {
            deleteUserById($id);
        } else {
            deleteEntryByTableAndID($type, $id);
        }

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

function generateModal($formName, $title, $btnTitle, $html, $id = "")
{
    global $type;
    $modalHtml = "<div id=\"modal\" class=\"modal show\" role=\"dialog\">
    <div class=\"modal-dialog\">
    <form method=\"post\" action='?type=$type&selected=$id'>
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

function deleteEntry($id, $name)
{
    global $type;
    $returnHtml = "";
    $typeName = getTypeName($type, false);
    $formName = "deleteEntry";
    $title = $typeName . " löschen";
    $html = "<input type='hidden' name='id' value='$id'>
             <p>Möchten Sie " . $typeName . " " . $name . " wirklich löschen?</p>";
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

function copyEntry($id, $name)
{

}

/**
 * @editEntry: Setzt passende Parameter für die Funktion 'generateModal',
 *           wenn ein Datensatz geändert werden soll.
 * Ausgabe: Reines html des generierten Modals
 */

function editEntry($id, $name)
{
    global $type;
    $typeName = getTypeName($type, false);
    $title = "$typeName $name bearbeiten";
    $formName = "editEntry";
    $btnTitle = "Speichern";
    $query = getQuery($type, $id);
    $html = generateHtml($query, $type);
    return generateModal($formName, $title, $btnTitle, $html, $id);
}

function generateHtml($query, $type)
{
    global $type;
    $columnNames = getColumnNames($type, false, false);
    $idColumn = getIDColumn($type);
    $html = "<table>";
    if ($query != null) {
        $html .= "<input type='hidden' name='$idColumn' value='$query[$idColumn]'>";
    }

    $columnText = getColumnText($type, false, false);

    for ($i = 0; $i < sizeof($columnNames); $i++) {
        $columnName = $columnNames[$i];
        $modalText = $columnText[$i];
        $options = getOptionAttributes($type, $columnName);

        if ($query != null && (strtolower($modalText) == "password" || strtolower($modalText) == "passwort")) {
            $query[$columnName] = "";
        }

        if ($options != null) {
            $optionList = findOption($options["table"], $query[$idColumn]);
            $html .= "<tr><td>$modalText</td><td><select class=\"form-control\" name=\"" . $options["id"] . "\">";
            foreach ($optionList as $j) {
                $selectedTag = "";
                $optionObj = $j["Elem"];
                $optionNr = $optionObj[$options["value"]];
                $optionId = $optionObj[$options["originalId"]];
                if ($query != null) {
                    if ($optionId == $query[$options["id"]]) {
                        $selectedTag = "selected";
                    }
                }
                $html .= "<option $selectedTag value=\"$optionId\">$optionNr</option>";
            }
            $html .= "</select></td></tr>";
        } else {
            $readonlyTag = "";
            if (strtolower($columnName) == "username" && $query != null) {
                $readonlyTag = "readonly";
            }
            $html .= "<tr><td>$modalText</td><td><input $readonlyTag type='text' class='form-control' name='$columnName' value='$query[$columnName]'></td></tr>";
        }
    }
    $html .= "</table>";
    return $html;
}

/**
 * @newEntry: Setzt passende Parameter für die Funktion 'generateModal',
 *            wenn ein Datensatz erstellt werden soll.
 * Ausgabe: Reines html des generierten Modals
 */

function newEntry()
{
    global $type;
    $columnNames = getColumnNames($type, false, false);
    $columnText = getColumnText($type, false, false);
    $typeName = getTypeName($type, false);
    $formName = "newEntry";
    $title = "$typeName anlegen";
    $html = "";
    $btnTitle = "Speichern";
    $html = generateHtml(null, $type);
    return generateModal($formName, $title, $btnTitle, $html);
}

?>