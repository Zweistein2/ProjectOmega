
//Füllt die Tabelle mit Daten die durch die Page Variable eingegrenzt wurde
function renderTable(page) {
    $("tbody").html("");
    var viewModel = javascript_array;
    for (var i = (page - 1) * 10; i < page * 10; i++) {
        var htmlString = "" +
            "<tr>\n" +
            "<td>" + viewModel[i]["ID"] + "</td>\n" +
            "<td>" + viewModel[i]["Hersteller"] + "</td>\n" +
            "<td>" + viewModel[i]["CPU"] + "</td>\n" +
            "<td>\n" +
            "<div class=\"checkbox\">\n" +
            "<input type=\"checkbox\" value=\"\">\n" +
            "</div>\n" +
            "</td>\n" +
            "</tr>";
        $("tbody").append(htmlString, null);
        $("#pageCounter").html("<a href=\"#\">" + page + "</a>")
    }
}

function Init() {
    var page = 1;
    renderTable(page);

    $("#prev").click(function () {
        page--;
        renderTable(page);
    });

    $("#next").click(function () {
        page++;
        renderTable(page);
    });

    $("#lastPage").click(function () {
        renderTable(javascript_array.length/10);
    });

    $("#firstPage").click(function () {
        renderTable(1);
    });
}