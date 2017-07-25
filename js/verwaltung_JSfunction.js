//Indexerklärung
//0 -> ID
//1 -> Bezeichnung
//2 -> Raum
//3 -> Checkbox true/false

//TODO: Alles auf Datenbank umstellen
//TODO: Löschen basierend darauf ob die Checkbox auf true oder false steht

//Füllt die Tabelle mit Daten die durch die Page Variable eingegrenzt wurde
function renderTable(page) {
    $("tbody").html("");
    for (var i = (page - 1) * 10; i < page * 10 && hardwareArray[i] != null; i++) {
        var checked = "";
        if(hardwareArray[i][3]){
            checked = "checked";
        }
        var htmlString = "" +
            "<tr id='"+i+"'>\n" +
            "<td>" + hardwareArray[i][0] + "</td>\n" +
            "<td>" + hardwareArray[i][1] + "</td>\n" +
            "<td>" + hardwareArray[i][2] + "</td>\n" +
            "<td>\n" +
            "<div class=\"checkbox\">\n" +
            "<input type=\"checkbox\" "+checked+" value=\"\">\n" +
            "</div>\n" +
            "</td>\n" +
            "</tr>";
        $("tbody").append(htmlString, null);
        $("#pageCounter").html("<a href=\"#\">" + page + "</a>")
    }
    bindTableFunctions();
}

function renderSelectbox() {

    var htmlString = "";
//TODO: Durch Auwahl einer option neuer seitenaufruf mit der modifizierten Url
    for(var i = 0;i < hardwareArtenArray.length; i++){
        var item = hardwareArtenArray[i];
        var selected = "";
        if(artParam == item.toLowerCase()){selected = "selected"}
        htmlString += "<option \"+ selected +\"><a href='../php/pages/verwaltung_ausmusterung.php?art="+item+"'>"+item+"</a></option>"
    }
    $(".selectPicker").html(htmlString);
}

//Funktionen die das blättern in der Tabelle ermöglichen
function bindPaginationFunctions(page) {
    $("#prev").click(function () {
        if(page == 1){return;}
        page--;
        renderTable(page);
    });

    $("#next").click(function () {
        if(hardwareArray.length/10 <= page){return;}
        page++;
        renderTable(page);
    });

    $("#lastPage").click(function () {
        var bigPage = hardwareArray.length/10;
        renderTable(Math.round( bigPage+0.4));
    });

    $("#firstPage").click(function () {
        renderTable(1);
    });
}

//Muss immer aufgeruden werden wenn die Tabelle neu gerendert wird
function bindTableFunctions() {
    $("input").click(function (args) {
        var trID = $(args.target).parents("tr")[0].id;
        if(hardwareArray[trID][3]){
            hardwareArray[trID][3] = false;
        }
        else{
            hardwareArray[trID][3] = true;
        }
    });
}

function Init() {
    var page = 1;
    renderTable(page);
    renderSelectbox();
    bindPaginationFunctions(page);
    bindTableFunctions();
}