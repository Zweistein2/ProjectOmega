//Füllt die Tabelle mit Daten die durch die Page Variable eingegrenzt wurde
function renderTable(page) {
    $("tbody").html("");
    var viewModel = javascript_array;
    for (var i = (page - 1) * 10; i < page * 10; i++) {
        var htmlString = "" +
            "<tr>\n" +
            "<td>" + viewModel[i][0] + "</td>\n" +
            "<td>" + viewModel[i][1] + "</td>\n" +
            "<td>" + viewModel[i][2] + "</td>\n" +
            "</tr>";
        $("tbody").append(htmlString, null);
        $("#currentPage").html("<a href=\"#\">" + page + "</a>")
    }
}

function Init() {
    var page = 1;
    renderTable(page);

    if(page == 1 && page == javascript_array.length/10) {
        $("#forward").setAttribute("class", "disabled");
        $("#firstPage").setAttribute("class", "disabled");
        $("#backward").setAttribute("class", "disabled");
        $("#firstPage").setAttribute("class", "disabled");
    }

    $("#backward").click(function () {
        if(page > 1) {
            page--;
        }
        if(page == 1) {
            $("#forward").setAttribute("class", "");
            $("#firstPage").setAttribute("class", "");
            $("#backward").setAttribute("class", "disabled");
            $("#firstPage").setAttribute("class", "disabled");
        }
        renderTable(page);
    });

    $("#forward").click(function () {
        if(page < javascript_array.length/10) {
            page++;
        }
        if(page == javascript_array.length/10) {
            $("#forward").setAttribute("class", "disabled");
            $("#firstPage").setAttribute("class", "disabled");
            $("#backward").setAttribute("class", "");
            $("#lastPage").setAttribute("class", "");
        }
        renderTable(page);
    });

    $("#lastPage").click(function () {
        page = javascript_array.length/10;
        $("#forward").setAttribute("class", "disabled");
        $("#firstPage").setAttribute("class", "disabled");
        $("#backward").setAttribute("class", "");
        $("#lastPage").setAttribute("class", "");
        renderTable(javascript_array.length/10);
    });

    $("#firstPage").click(function () {
        page = 1;
        $("#forward").setAttribute("class", "");
        $("#firstPage").setAttribute("class", "");
        $("#backward").setAttribute("class", "disabled");
        $("#lastPage").setAttribute("class", "disabled");
        renderTable(1);
    });
}