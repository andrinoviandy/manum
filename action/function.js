let jumlah_data;
let ceil_data;
//sipp
function countData(ceil, jm) {
    ceil_data = ceil !== undefined ? ceil : 0;
    jumlah_data = jm !== undefined ? jm : 0;
    $('#jumlah_data').text('Jumlah Data : ' + jumlah_data)
}
function countData1(ceil, jm) {
    let ceil_data = ceil !== undefined ? ceil : 0;
    let jumlah_data = jm !== undefined ? jm : 0;
    $('#jumlah_data1').text('Jumlah Data : ' + jumlah_data)
}
function countData2(ceil, jm) {
    ceil_data = ceil !== undefined ? ceil : 0;
    jumlah_data = jm !== undefined ? jm : 0;
    $('#jumlah_data2').text('Jumlah Data : ' + jumlah_data)
}
function countData3(ceil, jm) {
    ceil_data = ceil !== undefined ? ceil : 0;
    jumlah_data = jm !== undefined ? jm : 0;
    $('#jumlah_data3').text('Jumlah Data : ' + jumlah_data)
}
// sipp
function suksesAlert(action, page) {
    const pesan = (action === 'add' || action === 'edit') ? 'Berhasil Tersimpan !' : 'Berhasil Dihapus !';
    Swal.fire(
        pesan,
        '',
        'success',
    ).then(() => {
        loadContent(page)
    })
}
// sipp
function gagalAlert(action) {
    const pesan = (action === 'add' || action === 'edit') ? 'Gagal Tersimpan !' : 'Gagal Dihapus !';
    Swal.fire(
        pesan,
        '',
        'error',
    )
}
//sipp
function gagalLogin() {
    const pesan = 'Login Gagal !';
    Swal.fire(
        pesan,
        'Pastikan Username dan Password Anda Benar !',
        'error',
    )
}
//sipp
function loading() {
    $.get("manum/content/loading/loading.php",
        function (data) {
            $('#tbody').html(data)
        }
    );
}
//sipp
function aktifMenu(menu) {
    const ArrayMenu = ["beranda", "paket_umrah", "pendaftaran_jamaah", "on_progress", "data_jamaah", "master_cabang", "pengaturan_users", "pengaturan_provinsi", "pengaturan_kabupaten", "pengaturan_marketing", "keuangan_ringkasan", "keuangan_kas", "keuangan_invoice", "keuangan_reimburse", "keuangan_penerimaan", "keuangan_pengeluaran", "keuangan_kategori"];
    let filterMenu = ArrayMenu.filter(a => menu.includes(a) === true);
    if (filterMenu[0].includes('pengaturan') === true || filterMenu[0].includes('keuangan') === true) {
        $(".nav-item").removeClass("menu-open");
        $("#" + filterMenu[0].split("_")[0]).addClass("menu-open");
        $(".nav-link").removeClass("active");
        $("#" + filterMenu[0].split("_")[0] + "2").addClass("active");
        $("#" + filterMenu[0]).addClass("active");
    } else {
        $(".nav-item").removeClass("menu-open");
        $(".nav-item").removeClass("menu-is-opening");
        $(".nav-treeview").css("display", "none");
        $(".nav-link").removeClass("active");
        $("#" + filterMenu[0]).addClass("active");
    }
    url = filterMenu[0]
}
// sipp
function fetchData(page, objek = {}) {
    // loading()
    $.get("manum/content/list/" + page + ".php", objek,
        function (data) {
            $("#tbody").html(data)
        }
    );
    // $.ajax({
    //     success: function () {
    //         $('#tbody').html("manum/content/list/" + page + ".php")
    //     }
    // });
}
// sipp
function fetchData2(page, objek = {}) {
    $.get("content/list/" + page + ".php", objek,
        function (data) {
            $("#tbody").html(data)
        }
    );
}
function fetchDataCustom(page, objek = {}) {
    // loading()
    $.post("manum/content/list/" + page + ".php", objek,
        function (data) {
            if (objek.tbody) {
                $(`#${objek.tbody}`).html(data)
            } else {
                $("#tbody").html(data)
            }
        }
    );
}
function simpan_data(page, toPage = '') {
    loadingToSave(true)
    var dataform = $('#formData')[0];
    var data = new FormData(dataform);

    $.ajax({
        type: "POST",
        url: `manum/action/simpan/simpan_${page}.php`,
        data: data,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            loadingToSave(false)
            if (data == '1') {
                fetchData(page)
                if (toPage === '') {
                    suksesAlert('add', `${page}`)
                } else {
                    suksesAlert('add', `${toPage}`)
                }
            } else if (data == '0') {
                gagalAlert('add')
            }
            else {
                Swal.fire(
                    'Tidak Dapat Disimpan !',
                    data,
                    'error'
                )
            }
        }
    });
}
function ubah_data(page) {
    loadingToSave(true)
    var dataform = $('#formData')[0];
    var data = new FormData(dataform);
    $.ajax({
        type: "POST",
        url: `manum/action/ubah/ubah_${page}.php`,
        data: data,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            loadingToSave(false)
            if (data == '1') {
                fetchData(page)
                suksesAlert('edit', `${page}`)
            } else if (data == '0') {
                gagalAlert('edit')
            } else {
                Swal.fire(
                    'Tidak Dapat Diubah !',
                    data,
                    'error'
                )
            }
        }
    });
}
function hapus_data(id, page, table) {
    loadingToSave(true)
    $.ajax({
        type: "POST",
        url: `manum/action/hapus/hapus.php`,
        // data: $("#form_" + page).serialize(),
        data: 'id=' + id + '&table=' + table,
        success: function (data) {
            loadingToSave(false)
            if (data === '1') {
                suksesAlert('delete', `${page}`)
            } else {
                gagalAlert('delete')
            }
        }
    });
}
//sipp
function cari_data(page) {
    loading()
    var key = $('#table_search').val();
    $.ajax({
        type: "POST",
        url: "manum/content/list/" + page + ".php",
        data: "search=" + key + '&show=' + $('#show').val(),
        success: function (response) {
            $('#tbody').html(response)
        }
    });
}
function cari_dataCustom(page, objek) {
    loading()
    var key = $('#table_search').val();
    var show = $('#show').val();
    $.post("manum/content/list/" + page + ".php", { search: key, show: show, ...objek },
        function (response) {
            if (objek.tbody) {
                $('#' + objek.tbody).html(response)
            } else {
                $('#tbody').html(response)
            }
        }
    );
}
//sipp
function show_data(show, page) {
    $('#paging').val(1)
    $.post("manum/content/list/" + page + ".php", { show: show, search: $('#table_search').val() },
        function (response) {
            $('#tbody').html(response)
        }
    );
    // $.ajax({
    //     type: "POST",
    //     url: "manum/content/list/" + page + ".php",
    //     data: "show=" + show,
    //     success: function (response) {
    //         $('#tbody').html(response)
    //     }
    // });
}
function show_dataCustom(show, page, objek) {
    $('#paging').val(1)
    $.post("manum/content/list/" + page + ".php", { show: show, search: $('#table_search').val(), ...objek },
        function (response) {
            if (objek.tbody) {
                $('#' + objek.tbody).html(response)
            } else {
                $('#tbody').html(response)
            }
        }
    );
    // $.ajax({
    //     type: "POST",
    //     url: "manum/content/list/" + page + ".php",
    //     data: "show=" + show,
    //     success: function (response) {
    //         $('#tbody').html(response)
    //     }
    // });
}
function loadingToSave(param) {
    if (param === true) {
        Swal.fire({
            title: '<i class="fas fa-2x fa-sync-alt fa-spin text-white"></i>',
            showConfirmButton: false,
            allowOutsideClick: false,
            background: 'rgba(0, 0, 0, 0)'
        })
    }
    if (param === false) {
        Swal.close()
    }
}
// sipp
function alertBeforeDelete(id, page, table) {
    Swal.fire({
        title: 'Hapus Data ?',
        text: "Kamu Yakin Menghapus Item Ini",
        icon: 'warning',
        showCancelButton: true,
        // confirmButtonColor: '#3085d6',
        // cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batalkan'
    }).then((result) => {
        if (result.isConfirmed) {
            hapus_data(id, page, table)
        }
    })
}
//sipp
function exit() {
    Swal.fire({
        title: 'Anda Yakin Ingin Keluar ?',
        text: "Session Kamu Akan Terhapus",
        icon: 'warning',
        showCancelButton: true,
        // confirmButtonColor: '#3085d6',
        // cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batalkan'
    }).then((result) => {
        if (result.isConfirmed) {
            $.get("manum/action/login/logout.php", function (params) {

            });
            $.post("manum/action/login/logout.php",
                function (data) {
                    if (data == '1') {
                        window.location.href = 'manum/login.php'
                    }
                }
            );
        }
    })
}
//sipp
function login() {
    loadingToSave(true)
    var dataform = $('#formData')[0];
    var data = new FormData(dataform);
    $.ajax({
        type: "POST",
        url: `action/login/login.php`,
        data: data,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            loadingToSave(false)
            if (data === '1') {
                window.location.href = '/manum'
            } else {
                gagalLogin()
            }
        }
    });
}
// function loadEdit(id, page) {
//     // $.post(`manum/content/${page}.php`, { id: id },
//     // function (data) {
//     //     $('#content').html(data)
//     //     }
//     // );
//     loadContent(page).then(() => {
//         $.ajax({
//             type: "POST",
//             url: `manum/content/${page}.php`,
//             data: 'id=' + id
//         });
//     })
// }
//sipp
function paging(action) {
    var paging = parseInt($('#paging').val())
    // var ceil_data = parseInt($('#ceil_data').val())
    if (action == 'prev') {
        if (paging !== 1) {
            paging = paging - 1
            $('#paging').val(paging);
            $.post("manum/content/list/" + url + ".php", { action: action, paging: paging, show: parseInt($('#show').val()), search: $('#table_search').val() },
                function (response) {
                    $('#tbody').html(response)
                }
            );
        }
    }
    if (action == 'next') {
        if (paging < ceil_data) {
            paging = paging + 1
            $('#paging').val(paging);
            $.post("manum/content/list/" + url + ".php", { action: action, paging: paging, show: parseInt($('#show').val()), search: $('#table_search').val() },
                function (response) {
                    $('#tbody').html(response)
                }
            );
        }
    }
}
function pagingCustom(action, page, objek) {
    var paging = parseInt($('#paging').val())
    // var ceil_data = parseInt($('#ceil_data').val())
    if (action == 'prev') {
        if (paging !== 1) {
            paging = paging - 1
            $('#paging').val(paging);
            $.post("manum/content/list/" + page + ".php", { action: action, paging: paging, show: parseInt($('#show').val()), search: $('#table_search').val(), ...objek },
                function (response) {
                    if (objek.tbody) {
                        $('#' + objek.tbody).html(response)
                    } else {
                        $('#tbody').html(response)
                    }
                }
            );
        }
    }
    if (action == 'next') {
        if (paging < ceil_data) {
            paging = paging + 1
            $('#paging').val(paging);
            $.post("manum/content/list/" + page + ".php", { action: action, paging: paging, show: parseInt($('#show').val()), search: $('#table_search').val(), ...objek },
                function (response) {
                    if (objek.tbody) {
                        $('#' + objek.tbody).html(response)
                    } else {
                        $('#tbody').html(response)
                    }
                }
            );
        }
    }
}

function dropdown(name, table, field, id = 0, idParent = 0, where = "", req = "") {
    $.get("manum/content/dropdown/dropdown.php", { name: name, table: table, field: field, id: id, idParent: idParent, where: where, req: req },
        function (response) {
            $(`#${name}`).html(response)
        }
    );
}
function dropdownProses(name, id = 0, req = "") {
    $.get("manum/content/dropdown/dropdownProses.php", { id: id, req: req },
        function (response) {
            $(`#${name}`).html(response)
        }
    );
}
//sipp
function tandaPemisahTitik(b) {
    var _minus = false;
    if (b < 0) _minus = true;
    b = b.toString();
    b = b.replace(".", "");
    b = b.replace("-", "");
    c = "";
    panjang = b.length;
    j = 0;
    for (i = panjang; i > 0; i--) {
        j = j + 1;
        if (((j % 3) == 1) && (j != 1)) {
            c = b.substr(i - 1, 1) + "." + c;
        } else {
            c = b.substr(i - 1, 1) + c;
        }
    }
    if (_minus) c = "-" + c;
    return c;
}

function numbersonly(ini, e) {
    if (e.keyCode >= 49) {
        if (e.keyCode <= 57) {
            a = ini.value.toString().replace(".", "");
            b = a.replace(/[^\d]/g, "");
            b = (b == "0") ? String.fromCharCode(e.keyCode) : b + String.fromCharCode(e.keyCode);
            ini.value = tandaPemisahTitik(b);
            return false;
        } else if (e.keyCode <= 105) {
            if (e.keyCode >= 96) {
                //e.keycode = e.keycode - 47;
                a = ini.value.toString().replace(".", "");
                b = a.replace(/[^\d]/g, "");
                b = (b == "0") ? String.fromCharCode(e.keyCode - 48) : b + String.fromCharCode(e.keyCode - 48);
                ini.value = tandaPemisahTitik(b);
                //alert(e.keycode);
                return false;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else if (e.keyCode == 48) {
        a = ini.value.replace(".", "") + String.fromCharCode(e.keyCode);
        b = a.replace(/[^\d]/g, "");
        if (parseFloat(b) != 0) {
            ini.value = tandaPemisahTitik(b);
            return false;
        } else {
            return false;
        }
    } else if (e.keyCode == 95) {
        a = ini.value.replace(".", "") + String.fromCharCode(e.keyCode - 48);
        b = a.replace(/[^\d]/g, "");
        if (parseFloat(b) != 0) {
            ini.value = tandaPemisahTitik(b);
            return false;
        } else {
            return false;
        }
    } else if (e.keyCode == 8 || e.keycode == 46) {
        a = ini.value.replace(".", "");
        b = a.replace(/[^\d]/g, "");
        b = b.substr(0, b.length - 1);
        if (tandaPemisahTitik(b) != "") {
            ini.value = tandaPemisahTitik(b);
        } else {
            ini.value = "";
        }

        return false;
    } else if (e.keyCode == 9) {
        return true;
    } else if (e.keyCode == 17) {
        return true;
    } else {
        //alert (e.keyCode);
        return false;
    }
}

function lihatGambar(title, gambar) {
    $.post('manum/content/modal/lihat_gambar.php', { title: title, gambar: gambar },
        function (data, textStatus, jqXHR) {
            $('#modal-content').html(data);
            $('#modalGambar').modal('show');
        }
    );
    // $.ajax({
    //     url: 'manum/content/modal/'+ modal + '.php',
    //     type: 'POST',
    //     data: {
    //         gambar: gambar
    //     },
    //     success: function(data) {
    //         $('#modal-content').html(data);
    //         $('#modalGambar').modal('show')
    //     }
    // });
}

function dropdownOnChange(objek) {
    $.get("manum/content/dropdown/dropdownOnChange.php", {
        name: objek.name,
        table: objek.table,
        field: objek.field,
        where: objek.where,
        id_proses: objek.id_proses
    },
        function (response) {
            $(`#${objek.name}`).html(response)
        }
    );
}

function dropdownOnChangeMarketing(objek) {
    $.get("manum/content/dropdown/marketing.php", {
        name: objek.name,
        table: objek.table,
        field: objek.field,
        where: objek.where,
        id_proses: objek.id_proses
    },
        function (response) {
            $(`#${objek.name}`).html(response)
        }
    );
}

function exportToExcel(page, objek = {}) {
    window.location = "manum/action/export/" + page + ".php";
}

function exportToExcelById(page, id) {
    window.location = "manum/action/export/" + page + ".php?id=" + id;
}

function filterData(action, objek) {
    $.post('manum/content/modal/' + action + '.php', objek,
        function (data) {
            $('#modal-content-invoice').html(data);
            $('#modalInvoice').modal('show');
        }
    );
}

function dropdownCustom(objek) {
    $.get("manum/content/dropdown/dropdownCustom.php", objek,
        function (response) {
            $(`#${objek.name}`).html(response)
        }
    );
}

//on progress detail
function tambahInvoice(action, objek) {
    $.post('manum/content/modal/' + action + '.php', objek,
        function (data) {
            $('#modal-content-invoice').html(data);
            $('#modalInvoice').modal('show');
        }
    );
}
function ubahPaket(id, value) {
    Swal.fire({
        title: 'Ubah Paket ?',
        text: "Kamu Yakin Mengubah Paket Menjadi Yang Dipilih",
        icon: 'warning',
        showCancelButton: true,
        // confirmButtonColor: '#3085d6',
        // cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batalkan'
    }).then((result) => {
        if (result.isConfirmed) {
            loadingToSave(true)
            $.post("manum/action/ubah/ubah_paket.php", {
                id: id,
                value: value
            },
                function (data, textStatus, jqXHR) {
                    loadingToSave(false)
                    if (data == '1') {
                        Swal.fire(
                            'Berhasil Tersimpan !',
                            '',
                            'success',
                        )
                    } else {
                        Swal.fire(
                            'Gagal Tersimpan !',
                            '',
                            'error',
                        )
                    }
                    loadContent(url + '_detail', id)
                    dropdownOnChange({
                        name: 'dropdown_paket',
                        table: 'paket',
                        field: 'nama_paket',
                        where: "WHERE tayang = 1",
                        id_proses: id
                    })
                }
            );
        } else {
            dropdownOnChange({
                name: 'dropdown_paket',
                table: 'paket',
                field: 'nama_paket',
                where: "WHERE tayang = 1",
                id_proses: id
            })
        }
    })
}

function ubahMarketing(id, value) {
    Swal.fire({
        title: 'Ubah Marketing ?',
        text: "Kamu Yakin Akan Mengubah Marketing",
        icon: 'warning',
        showCancelButton: true,
        // confirmButtonColor: '#3085d6',
        // cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batalkan'
    }).then((result) => {
        if (result.isConfirmed) {
            loadingToSave(true)
            $.post("manum/action/ubah/ubah_marketing.php", {
                id: id,
                value: value
            },
                function (data, textStatus, jqXHR) {
                    loadingToSave(false)
                    if (data == '1') {
                        Swal.fire(
                            'Berhasil Tersimpan !',
                            '',
                            'success',
                        )
                    } else {
                        Swal.fire(
                            'Gagal Tersimpan !',
                            '',
                            'error',
                        )
                    }
                    loadContent(url + '_detail', id)
                    dropdownOnChangeMarketing({
                        name: 'dropdown_marketing',
                        table: 'marketing',
                        field: 'nama_marketing',
                        where: "",
                        id_proses: id
                    })
                }
            );
        } else {
            dropdownOnChangeMarketing({
                name: 'dropdown_marketing',
                table: 'marketing',
                field: 'nama_marketing',
                where: "",
                id_proses: id
            })
        }
    })
}
//batas