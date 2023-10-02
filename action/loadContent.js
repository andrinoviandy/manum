var url = window.location.href.split("?")[1];
function loadContent(menu, id = 0) {
    loadingToSave(true)
    if (menu !== '') {
        if (id == 0) {
            $.get("manum/content/" + menu + ".php",
                function (response) {
                    loadingToSave(false)
                    $('#content').html(response);
                }
            ).then(() => {
                aktifMenu(menu)
                fetchData(menu)
                window.history.pushState('', '', '/manum?' + menu);
            })
        } else {
            // url = menu;
            $.post("manum/content/" + menu + ".php", { id: id },
                function (response) {
                    loadingToSave(false)
                    $('#content').html(response);
                }
            ).then(() => {
                aktifMenu(menu)
                window.history.pushState('', '', '/manum?' + menu);
            })
        }
    }
}

$(document).ready(function () {
    // window.addEventListener("popstate", function () {
    var url2 = window.location.href.split("?")[1];
    //     this.$.get("content/" + url2 + ".php",
    //         function (response) {
    //             $('#content').html(response)
    //         }
    //     );
    //     // $('#content').load("content/" + url + ".php");
    //     window.history.pushState('', '', '/manum?' + url2);
    //     fetchData(url2)
    //     aktifMenu(url2)
    // });
    if (url2 === undefined) {
        loadingToSave(true)
        url2 = 'beranda';
        $.get("content/beranda.php",
            function (response) {
                loadingToSave(false)
                $('#content').html(response)
            }
        );
        aktifMenu('beranda')
        fetchData2('beranda')
        window.history.pushState('', '', '/manum?beranda');
    } else {
        loadingToSave(true)
        $.get("content/" + url2 + ".php",
            function (response) {
                loadingToSave(false)
                $('#content').html(response)
            }
        );
        aktifMenu(url2)
        fetchData2(url2)
        window.history.pushState('', '', '/manum?' + url2);
    }
});