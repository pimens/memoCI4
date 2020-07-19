$(function () {
    CKEDITOR.replace('editor1');
    getData();
    $("#add").hide(1000);
    $("#addButton").click(function () {
        $("#but_upload").show();
        $("#but_edit").hide();
        $("#add").show(1000);
    });
    $("#closeAdd").click(function () {
        $("#but_edit").show();
        $("#add").hide(1000);
    });
    $("#jns").change(function () {
        getData();
    });
    $("#but_upload").click(function () {
        var fd = new FormData();
        // var files = $('#file')[0].files[0];
        var nomor = $('#nomor').val();
        var tanggal = $('#tanggal').val();
        var direktur = $('#dir').val();
        var kepada = $('#kepada').val();
        var jenis = $('#jenis').val();
        var hal = $('#hal').val();
        // var deskripsi = $('#editor1').val();
        var deskripsi = CKEDITOR.instances.editor1.getData();

        // fd.append('file', files);
        fd.append('nomor', nomor);
        fd.append('kepada', kepada);
        fd.append('direktur', direktur);
        fd.append('tanggal', tanggal);
        fd.append('deskripsi', deskripsi);
        fd.append('hal', hal);
        fd.append('jenis', jenis);
        $.ajax({
            url: 'home',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (response) {
                getData();
                $("#add").hide(1000);
                $("#but_edit").show();
                window.setTimeout(function () {
                    $(".alert").fadeTo(500, 0).slideUp(500, function () {
                        $(this).remove();
                    });
                }, 2000);
                document.getElementById("msg")
                    .innerHTML = `<div class ="alert alert-danger alert-dismissable"><button type='button' 
                        class='close' data-dismiss='alert' aria-hidden='true'></button>
                        <strong>Tambah Data Berhasil !</strong></div>`;
            },
        });
    });
    $("#but_edit").click(function () {
        var fd = new FormData();
        // var files = $('#file')[0].files[0];
        var nomor = $('#nomor').val();
        var tanggal = $('#tanggal').val();
        var direktur = $('#dir').val();
        var kepada = $('#kepada').val();
        var jenis = $('#jenis').val();
        var hal = $('#hal').val();
        // var deskripsi = $('#editor1').val();
        var id = $('#idpermohonan').val();
        var deskripsi = CKEDITOR.instances.editor1.getData();

        // fd.append('file', files);
        fd.append('nomor', nomor);
        fd.append('kepada', kepada);
        fd.append('direktur', direktur);
        fd.append('tanggal', tanggal);
        fd.append('deskripsi', deskripsi);
        fd.append('hal', hal);
        fd.append('jenis', jenis);
        $.ajax({
            url: 'home/actionEdit/' + id,
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (response) {
                getData();
                $("#add").hide(1000);
                $("#but_upload").show();
                console.log(response);
                window.setTimeout(function () {
                    $(".alert").fadeTo(500, 0).slideUp(500, function () {
                        $(this).remove();
                    });
                }, 2000);
                document.getElementById("msg")
                    .innerHTML = `<div class ="alert alert-danger alert-dismissable"><button type='button' 
                        class='close' data-dismiss='alert' aria-hidden='true'></button>
                        <strong>Update Data Berhasil !</strong></div>`;
            },
        });
    });
});

function hapus(id) {
    swal({
        title: 'Konfirmasi?',
        text: "Apakah anda yakin ingin menghapus data ini!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        closeOnConfirm: true
    },
        function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "home/" + id,
                    type: "DELETE",
                    dataType: "JSON",
                    success: function (data) {
                        if (data.status) //if success close modal and reload ajax table
                        {

                            swal({
                                title: "Data Berhasil dihapus",
                                type: "success",
                            });
                            getData();
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error adding / update data');
                    }
                });
            }
        });
}

function getData() {
    $.ajax({
        url: "Home/getDataPermohonan/" + $('#jns').val(),
        type: "get",
        success: function (data) {
            document.getElementById("memo").innerHTML = data;
            $('#tabelMemo').dataTable();
        },
    });
}

function getDetail(id) {
    $.ajax({
        url: "Home/edit/" + id,
        type: "PUT",
        dataType: "JSON",
        success: function (data) {
            $("#add").show(1000);
            $("#but_upload").hide(10);
            $("#but_edit").show();
            $('#nomor').val(data.nomor);
            $('#tanggal').val(data.tanggal);
            $('#dir').val(data.direktur);
            $('#kepada').val(data.kepada);
            $('#jenis').val(data.jenis);
            $('#hal').val(data.hal);
            $('#idpermohonan').val(data.id);

            CKEDITOR.instances.editor1.setData(data.deskripsi);
            // $('#editor1').val(data.deskripsi);
        },
    });
}